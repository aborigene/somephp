### How to execute this demo

Just build the container and deploy wherever you want

### How to trigger the workflow in Dynatrace

Create a bash file `secrets.sh` on the rout of the repo with the following contents:

```
#!/bin/bash
export CLIENT_ID=some client id
export CLIENT_SECRET=some secret
```

Make sure to replace with your own credentials.

Whenever you need to trigger a new workflow execution, execute the command:

```
./trigger_workflow.sh
```