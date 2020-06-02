
# Moodclap
My own personal web framework. Named 'Moodclap', because my mood was clapped massively after finding out that many existing frameworks are rather a pain in the arse to install.



Functions
---



**[Account](https://github.com/TASSIA710/Moodclap/blob/master/class/Account.php) class:**
> `Account->getID()`\
`Account->getUsername()`\
`Account->setUsername($username, $noUpdate=false)`\
`Account->getPassword()`\
`Account->setPassword($password, $noUpdate=false`\
`Account->getGroupID()`\
`Account->getGroup()`\
`Account->setGroupID($groupID, $noUpdate=false)`\
`Account->getFirstVisit()`\
`Account->setFirstVisit($firstVisit, $noUpdate=false)`\
`Account->getLastVisit()`\
`Account->setLastVisit($lastVisit, $noUpdate=false)`\
`Account->getFirstIP()`\
`Account->setFirstIP($firstIP, $noUpdate=false)`\
`Account->getLastIP()`\
`Account->setLastIP($lastIP, $noUpdate=false)`\
`Account->getFlags()`\
`Account->setFlags($flags, $noUpdate=false)`\
`Account->pushDB()`\
`Account->pullDB() `



**[AuthManager](https://github.com/TASSIA710/Moodclap/blob/master/class/AuthManager.php) class:**
> `AuthManager::initialize()`\
`AuthManager::getCurrentUser()`\
`AuthManager::getCurrentSession()`\
`AuthManager::hasPermission($permission)`\
`AuthManager::isLoggedIn()`\
`AuthManager::login($username, $password)`\
`AuthManager::logout()`\
`AuthManager::createAccount($username, $password)`



**[Breadcrumbs](https://github.com/TASSIA710/Moodclap/blob/master/class/Breadcrumbs.php) class:**
> `Breadcrumbs::add($name, $url)`\
`Breadcrumbs::get()`



**[Cache](https://github.com/TASSIA710/Moodclap/blob/master/class/Cache.php) class:**\
<sup>TODO</sup>


**[Cookies](https://github.com/TASSIA710/Moodclap/blob/master/class/Cookies.php) class:**
> `Cookie::setCookie($name, $value, $domain=CONFIG['cookie_domain'])`\
`Cookie::removeCookie($name, $domain=CONFIG['cookie_domain'])`\
`Cookie::getCookie($name)`



**[Database](https://github.com/TASSIA710/Moodclap/blob/master/class/Database.php) class:**
> `Database::connect()`\
`Database::query($sql)`\
`Database::prepare($sql, $data)`\
`Database::escape($str)`\
`Database::lastInsert()`\
`Database::getAccount($id)`\
`Database::getAccountByName($name)`\
`Database::createAccount($username, $password)`\
`Database::getGroup($id)`\
`Database::getGroupByNameID($id)`\
`Database::getGroupByName($name)`\
`Database::getAllGroups()`\
`Database::createGroup($name, $nameID)`\
`Database::getSession($token)`\
`Database::createSession($token, $id)`\
`Database::dropSession($token)`\
`Database::getQueryTime()`\
`Database::getQueryCount()`



**[Group](https://github.com/TASSIA710/Moodclap/blob/master/class/Group.php) class:**
> `Group::getDefault()`\
`Group::getSysAdmin()`\
`Group->getID()`\
`Group->getNameID()`\
`Group->setNameID($groupNameID, $noUpdate=false)`\
`Group->getName()`\
`Group->setName($groupName, $noUpdate=false)`\
`Group->getDescription()`\
`Group->setDescription($description, $noUpdate=false)`\
`Group->getPermissions()`\
`Group->getPermissionJSON()`\
`Group->getPermission($permission)`\
`Group->hasPermission($permission)`\
`Group->setPermission($permission, $value, $noUpdate=false)`\
`Group->unsetPermission($permission, $noUpdate=false)`\
`Group->grantPermission($permission, $noUpdate=false)`\
`Group->denyPermission($permission, $noUpdate=false)`\
`Group->setPermissions($permissions, $noUpdate=false)`\
`Group->setPermissionJSON($json, $noUpdate=false)`\
`Group->getSortDisplay()`\
`Group->setSortDisplay($sortDisplay, $noUpdate=false)`\
`Group->getSortPermission()`\
`Group->setSortPermission($sortPermission, $noUpdate=false)`\
`Group->pushDB()`\
`Group->pullDB()`



**[Header](https://github.com/TASSIA710/Moodclap/blob/master/class/Header.php) class:**
> `Header::addStylesheet($stylesheet)`\
`Header::removeStylesheet($stylesheet)`\
`Header::getStylesheets()`\
`Header::addScript($script)`\
`Header::removeScript($script)`\
`Header::getScripts()`\
`Header::getTitle()`\
`Header::setTitle($title)`\
`Header::requireBootstrap()`\
`Header::unrequireBootstrap()`\
`Header::requireFontAwesome()`\
`Header::unrequireFontAwesome()`



**[Markdown](https://github.com/TASSIA710/Moodclap/blob/master/class/Markdown.php) class:**\
<sup>TODO</sup>



**[Route](https://github.com/TASSIA710/Moodclap/blob/master/class/Route.php) class:**
> `Route::get($path, $callback)`\
`Route::post($path, $callback)`\
`Route::put($path, $callback)`\
`Route::patch($path, $callback)`\
`Route::delete($path, $callback)`\
`Route::options($path, $callback)`\
`Route::head($path, $callback)`\
`Route::match($methods, $path, $callback)`\
`Route::redirect($from, $to)`\
`Route::redirectPermanent($from, $to)`\
`Route::redirectInternal($from, $to)`\
`Route::any($path, $callback)`


**[Session](https://github.com/TASSIA710/Moodclap/blob/master/class/Session.php) class:**
> `Session::CreateSession($token, $id)`\
`Session->getToken()`\
`Session->getAccountID()`\
`Session->getAccount()`\
`Session->getLastLogin()`\
`Session->setLastLogin($lastLogin, $noUpdate=false)`\
`Session->getLastIP()`\
`Session->setLastIP($lastIP, $noUpdate=false)`\
`Session->getUserAgent()`\
`Session->setUserAgent($userAgent, $noUpdate=false)`\
`Session->getFlags()`\
`Session->setFlags($flags, $noUpdate=false)`\
`Session->pushDB()`\
`Session->pullDB()`



**[Utility](https://github.com/TASSIA710/Moodclap/blob/master/class/Utility.php) class:**
> `Utility::generateToken($length, $chars)`\
`Utility::generateSessionToken()`\
`Utility::escapeXSS($str)`\
`Utility::startsWith($str, $check)`\
`Utility::endsWith($str, $check)`\
`Utility::replaceFirst($from, $to, $content)`\
`Utility::getSessionID()`\
`Utility::getBrowser()`
