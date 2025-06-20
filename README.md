Users
Clients
Bookings
Service
Availability


Routes to add:

### 🌐 Public (Client-Facing) Routes

| URL Path            | Description                         |
|---------------------|-------------------------------------|
| `/`                 | Landing page or direct booking page |
| `/book`             | Booking form: service + date/time   |
| `/book/{user_slug}` | Booking form: for specific user     |
| `/book/confirm`     | Appointment confirmation page       |
| `/appointment/{id}` | View/reschedule/cancel appointment  |

---

### ✂️ Barber/Admin Routes (Protected)

| URL Path               | Description                            |
|------------------------|----------------------------------------|
| `/dashboard`           | Admin dashboard / daily overview       |
| `/appointments`        | Full calendar or list of bookings      |
| `/appointments/{id}`   | Appointment detail/edit page           |
| `/clients`             | List of all clients                    |
| `/clients/{id}`        | Individual client profile              |
| `/services`            | Manage services (add/edit/delete)      |
| `/settings/schedule`   | Set work hours, breaks, holidays       |
| `/settings/policies`   | Deposit & cancellation rules           |
| `/settings/profile`    | Update barber info, contact, branding  |

