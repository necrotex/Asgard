
v1.0.7 / 2018-08-08
===================
  
  * enable discord role management
  * added feedback feature
  * only give guest to non members
  * allow logins with invite code while registration is closed
  * used combined roles instead of assosicted ones
  * fixed unrestricted role selection on save
  * fixed missing discord role display
  * refactored discord integration
  * refactored role management for discord

v1.0.6 / 2018-08-06
===================

  * Added Discord Notifications for Recruitment Actions
  * added total isk of all characters to profile page. fixes #39
  * Merge branch 'feature/user-overview' into develop
  * added an all option to entries shown in datatables. fixes #38
  * added user overview. fixes #37
  * Fixed typo
  * Merge branch 'master' into develop
  * randomize the first haiku pick before responding
  * add recuring job to import haikus

v1.0.5 / 2018-08-02
===================

  * added haiku api and basic user api keys

v1.0.4 / 2018-07-27
===================

  * Allow new lines in application question answers while still escaping the text
  * updated dependencies
  * Optimize eager loading for better performance
  * Excluded recruitment/apply from csrf protection
  * Updated .env example
  * Fixed mail job
  * fixed timerboard issues with permissions and a bug with fresh migrations and double roles creation

v1.0.2 / 2018-07-25
===================

  * fixed user id on some routes
  * Release start

v1.0.1 / 2018-07-25
===================

  * added mailinglist id range as a rejection criteria to the id resolve rejection callback
  * changed recruitment welcome message
  * added hash ids for application and changed profile ids to names
  * fixed recruitment permissions
  * updated deployment script

v1.0.0 / 2018-07-23
===================

  * small task scheduling adjustments
  * made application form question descriptions optional
  * don't continue the character asset job if there are no ids to be resolved
  * fixed system log display
  * exclude the apply route from csrf token exceptions
  * fixed application form permission problems
  * use ability instead of role when update a user role via profile page
  * updated deploy script and backup task
  * backup and deploy fixed
  * envoyer deploy script
  * Added backup packaged and deploy script
  * added corporation members update task
  * changed discord oauth scopes

v1.0.0-beta3 / 2018-07-19
=========================

  * reorganizing roles #29
  * added corporation member list
  * fixed character overview when no skill is in training
  * exit out of contacts job if there are no contacts. fixes #33
  * extended character journal view. fixes #31
  * added location and current ship to character list in profile. fixes #27
  * update restcord
  * set explicit token type for discord
  * nicer character display in profile view
  * avoid recurision for associated roles
  * check if new roels are present before assigning them
  * recipents that couldn't get resolved still need to be added to the database
  * hardening mail import
  * fix wrong log message
  * show correct job class when logging an exception
  * make sure no mailing list ids are trying to be resolved
  * some refinement work on import jobs
  * some cronjob adjustments
  * normal character update job shouldn't update characters that didn't finsih the inital import
  * give better info when mail ids can't be resolved via esi
  * fixed some query logic
  * Added a reimport cron job for characters that failed to import the first time
  * Rewrote character contacts job. fixes #26
  * fixed so single timer actually have same structure and functions as overview. Can edit and delete from shortlink now too.
  * adjust timer removal
  * random adjustments
  * directors now can change roles of other people. fixes #25
  * Fixed wrong system messages link. fixes #24
  * Application Status and comments are only available to the correct permission now. fixes #23
  * fixed timerboard shortlinks, edit and default filled values

v1.0.0-beta2 / 2018-07-03
=========================

  * clean up
  * Asgard-12: Admins can link their reddit/discord account to other profiles
  * Asgard-11: Main Character can be changed by directors
  * Asgard-13: Corporation history is wrong
  * Asgard-15: Corporation Role inheritance is broken
  * Asgard-19: Fixed Character search.
  * update sde version
  * fixed dependency issues with the discord and reddit socialite provider
  * removed not needed event hook after character updates for service access checks. fixes #9
  * a user doesn't need permissions to link their discord account. fixes #7
  * removed javascript to remove alerts. fixes #6, #8
  * fixed typo in api call
  * removed null cache from transactions job
  * new version shit, after the old one didn't work
