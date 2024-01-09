O2E Technical Test
=======================

It was my hope to leverage devel generate and or AI to assist in this project.

Unfortunately, I've not yet setup or tested devel generate (did not want to go down any rabbit holes on the clock.
I'll do this afterward).

Also, the task reminded me of lots of training I'd done, so AI was not needed to help me find a path forward.
(this also would have been a first, though, I am keen to try. Not for writing the code, but for faster, assisted
'googling')

### Steps to get this working

- add this module, o2e_test, to your custom modules directory
- enable the module
- clear cache
- in a browser visit {yourlocalsite}/o2e_test/4/2555 (where 4 and 2555 are the integers you'd like to have added)


### Steps I followed

- create custom module /modules/custom/o2e_test/ (10:10am)
- create info file
- create rough routing yml
- create rough services yml
- create dir /modules/custom/o2e_test/src/Service
- create both classes, roughly
- create dir /modules/custom/o2e_test/Controller/
- add controller, calling both classes
- review naming throughout so far, in yml and class files, improve and align
- install module, get past errors (remaining naming errors, typos, etc)
- test in browser, get past errors (vars in routing must be === to args in method)
- test in browser, works! /o2e_test/1/2
- review requirements (11:10am)
- refactor controller to call only Service two, rename method to allow for extra work being done
- refactor service yml and Service two with DI for service 1
- test in browser, works! /o2e_test/4/2555
- review for naming, any other formatting cleanup to do, ensure there are no references in code to "dino_roar"
- review requirements
- write this file :) (12:05am)
- Start looking into uploading to github... will give another pass after that.
