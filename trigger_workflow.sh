#!/bin/bash

source ./secrets.sh
# Define variables for the first request
AUTH_URL="https://sso.dynatrace.com/sso/oauth2/token"
CLIENT_ID=${CLIENT_ID:-}
CLIENT_SECRET=${CLIENT_SECRET:-}
SCOPE="automation:workflows:run"

# Step 1: Request the authentication token using client credentials
# The -s flag is for silent mode, -S shows an error if it fails
# The -X POST flag specifies the HTTP request method
# The -H flag sets the Content-Type header
# The -d flag sends the form data
TOKEN=$(curl -sS -X POST "$AUTH_URL" \
    -H "Content-Type: application/x-www-form-urlencoded" \
    -d "grant_type=client_credentials&client_id=$CLIENT_ID&client_secret=$CLIENT_SECRET&scope=$SCOPE" \
    | jq -r .access_token) # Use jq to parse the JSON and extract the access_token

# Check if the token was successfully retrieved
if [ -z "$TOKEN" ]; then
    echo "Error: Failed to retrieve authentication token."
    exit 1
fi

# Define variables for the second request
WORKFLOW_URL="https://fov31014.apps.dynatrace.com/platform/automation/v1/workflows/409c00f9-c459-4bd9-9fc5-e8464542d17f/run"
WORKFLOW_PAYLOAD='{
  "params": {
        "service": "php_login",
        "stage": "pre-production",
        "total_test_time": 5
    }
}'

# Step 2: Use the token to trigger the workflow
# The -H flag sets both the Content-Type and Authorization headers
# The --data flag sends the JSON payload
# The final result of the curl command is printed to the console
curl -vvv -sS -X POST "$WORKFLOW_URL" \
    -H "Content-Type: application/json" \
    -H "Authorization: Bearer $TOKEN" \
    --data "$WORKFLOW_PAYLOAD"