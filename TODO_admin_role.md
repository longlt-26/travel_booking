them# TODO: Admin/Client separate pages (role column on users)

- [ ] Add `role` column to `users` table via migration.
- [ ] Update `App\Models\User` to include `role` in `$fillable` (and optionally helper method `isAdmin`).
- [ ] Create middleware `EnsureUserRole` (or use inline closure) to restrict admin/client routes.
- [ ] Add admin routes:
  - `/admin` (dashboard)
  - `/admin/bookings` (list bookings, optional)
- [ ] Create views for admin dashboard and client dashboard.
- [ ] Update navigation (layout) to show correct links based on role.
- [ ] Update seeder (optional): set first user/admin.

