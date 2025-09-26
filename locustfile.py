from locust import HttpUser, task, between

class MyUser(HttpUser):
    wait_time = between(1, 2)  # Adjust as needed
    users_type = [
        {"type": "platinum"},
        {"type": "platinum"},
        {"type": "platinum"},
        {"type": "gold"},
        {"type": "gold"},
        {"type": "gold"},
        {"type": "gold"},
        {"type": "silver"},
        {"type": "silver"},
        {"type": "silver"},
    ]
    user_type_index = 0

    @task
    def my_task(self):
        user_type = self.users_type[self.user_type_index]
        self.client.get(f"/login.php?user=user1&password=password&type={user_type['type']}")
        self.user_type_index = (self.user_type_index + 1) % len(self.users_type)