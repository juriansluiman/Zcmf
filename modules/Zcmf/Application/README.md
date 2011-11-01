Application module
===
The Zcmf\Application is the core of the Zcmf system. This module is built on the
principle of a list of pages, connected with a one-to-many relationship to different
modules. Every page points to one module.

Current features
---
1. Pages as tree stored in database
2. Pages parsed to routes
3. Routes injected to the router

Upcoming features
---
1. Multiple trees, to support a production and staging environment