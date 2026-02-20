# Agriculture Portal

A comprehensive machine learning-based web application designed to provide predictions, recommendations, and real-time information to farmers. The system integrates crop prediction, fertilizer recommendations, weather forecasts, and direct crop sales functionality with a modern web interface.

**Key Capabilities:**
- Uses machine learning algorithms to predict optimal crops, recommend fertilizers, and provide rainfall and yield predictions
- Direct crop sales marketplace for customers with secure payment integration using Razorpay
- AI-powered chatbot using OpenAI's GPT-3.5-turbo model for agricultural assistance
- Real-time weather forecasts (4-day predictions) using OpenWeatherMap API
- Curated agricultural news using News API
- Secure user authentication with OTP verification

## 🌟 Features

- ✅ **Crop Prediction** - ML-based predictions for optimal crop selection
- ✅ **Crop Recommendation** - Personalized recommendations based on soil and weather
- ✅ **Fertilizer Recommendation** - Smart fertilizer suggestions for better yields
- ✅ **Rainfall Prediction** - Advanced rainfall forecasting
- ✅ **Yield Prediction** - Estimated yield calculations
- ✅ **OTP Verification** - Secure email-based two-factor authentication
- ✅ **Agricultural News** - Real-time farming news using News API
- ✅ **AI Chatbot** - GPT-3.5-turbo powered agricultural assistant
- ✅ **Weather Forecast** - 4-day weather predictions
- ✅ **Direct Crop Sales** - Real-time crop marketplace with Razorpay payment integration
- ✅ **User Profiles** - Separate dashboards for Farmers, Customers, and Admin

## 📋 Prerequisites

Before you begin, ensure you have:

- **XAMPP** (Apache + MySQL/PHP) - Download from [apachefriends.org](https://www.apachefriends.org/)
- **Python 3.11+** - For ML models ([python.org](https://www.python.org/))
- **Git** - For version control
- **API Keys** (free tier available for all):
  - [News API](https://newsapi.org/) - Agriculture news
  - [OpenWeatherMap API](https://openweathermap.org/api) - Weather data
  - [OpenAI API](https://platform.openai.com/account/api-keys) - ChatGPT integration
  - [Razorpay API](https://razorpay.com/) - Payment gateway
  - Gmail App Password - For OTP emails

## 🚀 Quick Start

### 1. Install XAMPP

1. Download from [apachefriends.org](https://www.apachefriends.org/)
2. Run installer with default settings
3. Choose Apache and MySQL as components

### 2. Clone Repository

```bash
cd C:\xampp\htdocs
git clone https://github.com/vaishnavid0604/agriculture-portal.git
cd agriculture-portal-T1
```

### 3. Install Python Dependencies

```bash
cd farmer
pip install -r requirements.txt
cd ..
```

### 4. Configure Environment Variables

Create/update `.env` file in project root:

```env
# Database Configuration
DB_HOST=localhost
DB_USER=root
DB_PASSWORD=
DB_NAME=agriculture_portal

# OpenAI API (get from https://platform.openai.com/account/api-keys)
OPENAI_API_KEY=sk-proj-xxxxxxxxxxxxxxxxxxxx

# News API (get from https://newsapi.org/)
NEWS_API_KEY=your_news_api_key_here

# OpenWeather Map API (get from https://openweathermap.org/api)
OPENWEATHER_API_KEY=your_openweather_api_key_here

# Gmail SMTP Configuration
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your_app_password_here
MAIL_FROM=your-email@gmail.com

# Razorpay Configuration (get from https://razorpay.com/)
RAZORPAY_SECRET_KEY=your_razorpay_secret_key_here
RAZORPAY_PUBLIC_KEY=your_razorpay_public_key_here
```

**Important:** `.env` is in `.gitignore` - never commit it to Git!

### 5. Setup Gmail App Password

1. Go to [myaccount.google.com](https://myaccount.google.com/)
2. Click **Security** in left menu
3. Enable **2-Step Verification** (if not enabled)
4. Search for **App passwords**
5. Select **Mail** and **Windows Computer**
6. Copy the 16-character password
7. Paste into `.env` as `MAIL_PASSWORD`

### 6. Setup Database

**Start XAMPP:**
- Open XAMPP Control Panel
- Click **Start** for Apache and MySQL
- Wait for both to show green status

**Import database:**
1. Open `http://localhost/phpmyadmin`
2. Click **Databases** tab
3. Create new database: `agriculture_portal`
4. Click on the new database
5. Go to **Import** tab
6. Select `db/agriculture_portal.sql` from your project
7. Click **Import**

### 7. Configure Razorpay

1. Get API keys from [Razorpay Dashboard](https://dashboard.razorpay.com/)
2. Add to `.env` file (as shown in step 4)
3. Update URLs in `customer/cbuy_crops.php`:
   ```php
   'success_url' => 'http://localhost/agriculture-portal-T1/customer/cupdatedb.php',
   'cancel_url' => 'http://localhost/agriculture-portal-T1/customer/cbuy_crops.php',
   ```

### 8. Run Application

```powershell
# Make sure XAMPP is running (Apache and MySQL)
# Open browser and navigate to:
# http://localhost/agriculture-portal-T1/
```

## 👥 User Roles

| Role | Features |
|------|----------|
| **Farmer** | Crop prediction, recommendations, weather, news, chatbot, ML insights |
| **Customer** | Browse crops, purchase directly, track orders, manage cart |
| **Admin** | Manage users, monitor system, view statistics, manage database |

## 📂 Project Structure

```
agriculture-portal-T1/
├── index.php                 # Main landing page
├── contact.php               # Contact page
├── sql.php                   # Database connection
├── env_config.php           # Environment loader
├── .env                     # Configuration (gitignored)
├── .env.example             # Configuration template
│
├── admin/                   # Admin panel
│   ├── alogin.php
│   ├── afarmers.php
│   ├── acustomers.php
│   └── ...
│
├── farmer/                  # Farmer features
│   ├── fcrop_prediction.php
│   ├── fcrop_recommendation.php
│   ├── ffertilizer_recommendation.php
│   ├── fweather_forecast.php
│   ├── fnewsfeed.php
│   ├── fchatgpt.php
│   ├── requirements.txt
│   └── ML/                  # Machine Learning models
│       ├── crop_prediction/
│       ├── crop_recommendation/
│       ├── fertilizer_recommendation/
│       ├── rainfall_prediction/
│       └── yield_prediction/
│
├── customer/                # Customer features
│   ├── cregister.php
│   ├── cbuy_crops.php
│   ├── cstock_crop.php
	│   └── PaymentGateway/      # Payment integration
│
├── db/
│   └── agriculture_portal.sql  # Database schema
│
├── assets/                  # Static files
│   ├── css/
│   ├── js/
│   ├── img/
│   └── fonts/
│
└── smtp/                    # Email service
    └── class.phpmailer.php
```

## 🔐 Security Best Practices

1. **Never commit `.env`** - Use `.env.example` as template
2. **Use environment variables** - All secrets load from `.env`
3. **Revoke exposed keys immediately** - If accidentally committed
4. **Enable 2FA** - For all accounts
5. **Use HTTPS in production** - Not just HTTP
6. **Validate all inputs** - Prevent SQL injection and XSS
7. **Update dependencies regularly** - Security patches

## 🐛 Troubleshooting

### PHP not found
```powershell
php -v  # Should show PHP version
```
**Solution:** Ensure XAMPP is installed and in PATH

### Database connection error
**Solution:**
- Start MySQL in XAMPP Control Panel
- Verify `.env` database credentials
- Check database `agriculture_portal` exists in phpMyAdmin

### Email not sending
**Solution:**
- Verify Gmail app password (not regular password)
- Check "Less secure apps" setting
- Check spam/trash folder

### API keys not working
**Solution:**
- Verify keys in `.env` file
- Check API quota on provider dashboards
- Test keys directly on provider websites

### ML models not loading
```bash
pip install --upgrade pip
pip install -r farmer/requirements.txt
```

## 📊 ML Models Used

| Prediction | Algorithm | Accuracy |
|------------|-----------|----------|
| Crop Prediction | Logistic Regression | ~90% |
| Crop Recommendation | Decision Tree | ~85% |
| Fertilizer Recommendation | Naive Bayes | ~88% |
| Rainfall Prediction | Linear Regression | ~80% |
| Yield Prediction | Random Forest | ~87% |

## 🛠️ Technology Stack

- **Frontend:** HTML, CSS, Bootstrap 4, JavaScript, jQuery
- **Backend:** PHP 7.4+
- **Database:** MySQL 5.7+
- **ML/Data:** Python 3.11+, Scikit-learn, Pandas, NumPy, Matplotlib, Joblib
- **External APIs:** OpenAI, NewsAPI, OpenWeatherMap, Razorpay
- **Email:** PHPMailer with SMTP
- **Payment:** Razorpay/Stripe integration

## 📋 ML Model Datasets

### Crop Prediction Dataset
- State_Name, District_Name, Season, Crop

### Crop Recommendation Dataset
- N, P, K, Temperature, Humidity, pH, Rainfall, Label

### Fertilizer Recommendation Dataset
- Temperature, Humidity, Soil Moisture, Soil Type, Crop Type, Nitrogen, Phosphorous, Potassium

### Rainfall Prediction Dataset
- SUBDIVISION, YEAR, Monthly data (JAN-DEC), ANNUAL

### Yield Prediction Dataset
- State_Name, District_Name, Crop_Year, Season, Crop, Area, Production

## 🎓 How to Use Each Feature

### Crop Prediction
1. Login as Farmer
2. Enter State, District, Season
3. Get recommended crop for that region

### Crop Recommendation
1. Input soil parameters (N, P, K values)
2. Input weather data (Temperature, Humidity, pH)
3. Receive crop recommendations

### Fertilizer Recommendation
1. Input soil moisture and type
2. Input crop nutrient requirements
3. Get fertilizer recommendations

### Weather Forecast
1. Check 4-day forecast for your region
2. Plan farming activities accordingly

### AI Chatbot
1. Ask agriculture-related questions
2. Get AI-powered responses
3. Access crop and farming knowledge

## 📞 Getting API Keys

| API | Steps | Free Limit |
|-----|-------|-----------|
| **OpenAI** | Sign up → API Keys → Create key | 5 credits trial |
| **News API** | Register → Copy API key | 100 requests/day |
| **OpenWeatherMap** | Sign up → API keys → Get key | 60 calls/minute |
| **Razorpay** | Sign up → Settings → API keys | ₹0 test mode |
| **Gmail** | [See Step 5 above](#5-setup-gmail-app-password) | Built-in |

## 📄 License

This project is licensed under the MIT License - see [LICENSE](LICENSE) file for details.

## 🤝 Contributing

1. Fork the repository
2. Create feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📞 Support

For help or questions:
1. Check **Troubleshooting** section above
2. Review error logs in browser console
3. Check PHP error logs in XAMPP `logs/` directory
4. Verify all configurations in `.env`

## 🔗 Useful Links

- [XAMPP Download](https://www.apachefriends.org/)
- [Python Download](https://www.python.org/)
- [News API](https://newsapi.org/)
- [OpenWeatherMap API](https://openweathermap.org/api)
- [OpenAI Platform](https://platform.openai.com/)
- [Razorpay Documentation](https://razorpay.com/docs/)
- [GitHub Repository](https://github.com/vaishnavid0604/agriculture-portal)

---

**Last Updated:** February 2026 | **Version:** 2.0

**Note:** This is an educational project. For production use, ensure proper security measures and compliance with data protection regulations.
