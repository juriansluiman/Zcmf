Admin module
===
This module is a portal for other modules to provide an admin interface through
a unified look and feel. A module is connected to this admin interface when a
class ModuleName\Admin can be found which implements the interface Zcmf\Admin\AdminAware.

Theory of operation
---
This module provides the ability to create, modify and delete pages for the
Zcmf\Application module. The stucture is loosely coupled and no definitions
are made how a module should structure its interface. The routing is semi-flexible,
having a fixed controllername/actionname in the url and leaving other parameters
up to the module.

Good practices
---
The interface AdminAware is created to make it possible having seperate namespaces
for the module content and the admin part of the module. For example, the blog
module from Zcmf has a Zcmf\Blog namespace for the visitor related code and a
Zcmf\BlogAdmin namespace for all controllers and additional forms & services to
provide the additional functionality.

It is therefore recommended to keep the admin logic in a seperate namespace
and provide this namespace through the AdminAware::getNamespace() method.