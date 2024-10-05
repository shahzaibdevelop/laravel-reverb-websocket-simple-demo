## 📡 Realtime Laravel Websocket Notifications using Reverb

Unlock the power of real-time notifications in your Laravel applications with Reverb! 🚀 Here's how you can get started in just a few simple steps:

### 🛠️ Installation Steps

To set up your project, run the following commands in your terminal:

1. Install PHP dependencies:
```bash
    composer install
```

2. Install Node.js dependencies:
```bash
    npm install
```

3. Start the Reverb server:
```bash
    php artisan reverb:start
```

 **Note:** If you switch from `shouldBroadcastNow` to `shouldBroadcast`, run the following command to queue the event:
 
 ```bash
 php artisan queue:work
 ```

4. Launch your Laravel application:
```bash
    php artisan serve
```

5. Compile your assets:
```bash
    npm run dev
```

### 🚀 Start Building!

You are now ready to dive into building your Laravel application with real-time notifications! Enjoy coding! 🎉
