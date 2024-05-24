# GitHub Webhook to Telegram and Discord

This project provides a simple PHP script to receive GitHub webhook notifications and forward them to a specific topic in a Telegram group and a Discord channel.

## Prerequisites

- A web server with PHP support (e.g., Apache, Nginx)
- A Telegram bot token
- Telegram chat ID and topic ID
- Discord webhook URL

## Getting Started

### 1. Clone the Repository

Clone this repository to your web server:

```sh
git clone https://github.com/amirhfarahani/github-to-topicTelegram-discord.git
cd github-to-topicTelegram-discord.git
```

### 2. Configure Telegram Bot

1. Create a new bot using BotFather on Telegram and obtain the bot token.
2. Add the bot to your group and promote it to an admin.
3. Send a message in the group topic you want to use, then copy the message link to get the chat ID and topic ID.

### 3. Create Discord Webhook

1. Go to your Discord server.
2. Open channel settings and navigate to Integrations.
3. Create a new webhook and copy the webhook URL.

### 4. Update Configuration

Edit the `webhook.php` file and update the following variables with your configuration:

```php
$telegramBotToken = 'YOUR_TELEGRAM_BOT_TOKEN';
$telegramChatId = 'YOUR_CHAT_ID'; // Group chat ID
$telegramTopicId = 'YOUR_TOPIC_ID'; // Topic ID
$discordWebhookUrl = 'YOUR_DISCORD_WEBHOOK_URL';
```

### 5. Deploy the Script

Upload the `webhook.php` file to your web server.

### 6. Configure GitHub Webhook

1. Go to your GitHub repository.
2. Navigate to `Settings > Webhooks`.
3. Click `Add webhook`.
4. Set the `Payload URL` to the URL of your deployed `webhook.php` file (e.g., `https://yourserver.com/webhook.php`).
5. Set `Content type` to `application/json`.
6. Select the individual events you want to trigger the webhook, such as `push` events.
7. Click `Add webhook`.

## Testing

You can test the setup by triggering a GitHub event, such as pushing a commit to your repository. You should see the notification in your Telegram group topic and Discord channel.

To manually test, you can use the following `curl` command:

```sh
curl -X POST -H "Content-Type: application/json" -d '{"repository": {"full_name": "myrepo/test"}, "pusher": {"name": "testuser"}}' https://yourserver.com/webhook.php
```
