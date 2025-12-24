# TODO: Implement Professional Filters, Soft Delete, Restore/Force Delete, and Logging for Products

## Steps to Complete

- [ ] Clean up routes/admin.php: Remove duplicate routes and add forceDelete route
- [ ] Update resources/views/backend/products/index.blade.php:
  - Move filters to a proper form above the table
  - Add status filter (active/trash)
  - Enhance date filters
  - Add table columns for Created By, Updated By, Deleted By
  - Add restore and force delete buttons for trashed products; soft delete for active
- [ ] Test filtering, soft delete, restore, and force delete functionality
- [ ] Verify audit logging display in the table
