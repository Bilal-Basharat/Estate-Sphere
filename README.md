# EstateSphere

**EstateSphere** is a full-featured real estate platform that enables users to **buy**, **sell**, and **manage** real estate listings. Whether you're a homebuyer or a realtor, EstateSphere provides a seamless experience from discovery to deal closure.

---

## 🚀 Features

### 🏘️ Public & Client-Facing
- Browse all available real estate listings.
- Filter by:
  - Number of beds
  - House area (sq. ft.)
  - Minimum and maximum price
- View individual listings with:
  - Full details
  - Image galleries
  - Mortgage & monthly payment simulation
  - Ability to make an offer (if signed in)

### 🧾 Offers & Mortgage
- Simulate mortgage & monthly payments
- Submit offers (requires account & login)
- Notifications & emails for offer submissions

### 🔐 Authentication
- Secure user registration with email confirmation
- Login & session management (JWT/session-based)
- Role-based access (User vs. Realtor)

### 🧑‍💼 Realtor Dashboard
- View all your own listings
- Add, edit, or delete property listings
- Upload images for listings
- View and manage all incoming offers
- Accept offers → Auto-mark property as **SOLD**

### 🔔 Notifications
- Real-time bell icon indicators for:
  - New offers
  - Offer accepted
  - Listing updates
- Email alerts for all major actions

---

## 🛠️ Tech Stack

| Layer        | Technology                  |
|--------------|-----------------------------|
| Frontend     | Vue.js                      |
| Backend      | PHP Laravel                 |
| Database     | MySQL                       |
| Auth         | JWT + Email Verification    |
| Storage      | AWS S3 / Cloudinary         |
| Notifications| Socket.IO + Nodemailer      |
| Deployment   | Vercel / Netlify + Heroku   |

---