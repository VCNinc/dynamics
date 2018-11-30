# Final Project Proposal - Vivek Nair
### Introduction
Wolfram Alpha is a well-known example of what is known as an *answers engine* (or a *computational knowledge engine*), which differs from a search engine in that it attempts to directly answer a user's query rather than simply searching for websites that closely match the user's request.

But we can go further than this through what's called an *interactive* answers engine: an engine that not only answers the query of a user, but does so in a **dynamic** way so as to allow them to answer potential follow-up questions without having to perform another search. A good example of this can be found by searching for "[10 lbs to kg](https://www.google.com/search?q=10%20lbs%20to%20kgs)" on Google. Here, Google not only helpfully displays the answer 4.53 kgs, but also allows the user to change the number 10 to something else and immediately obtain a new answer. This functionality can be extended queries of all kinds by packaging the means to answer all likely follow-up questions with the answer to the original question.

Another unique property that an engine can have is *contextualization*. This means that an engine can utilize user data to provide structure to an answer. Contextualized answers will be different from user to user; for example searching for "[my latest emails](https://www.google.com/search?q=my%20latest%20emails)" on Google will provide a logged-in user with their actual emails.

### "Dynamics" Engine
The key features of being interactive and contextualized can be combined to create a unique type of search engine that returns customized, dynamic results. The goal here is not just to answer a single question that a user is having but to provide the means to solve a problem or set of problems. If search engines return websites, and knowledge engines return answers, then Dynamics returns *tools* that solve one or more issues that a user may be having. An individual result, or "Dynamic," can be saved for later use by the user; because each result is its own interactive tool, saving a search result is more analogous to downloading a new software widget onto a device.

### Features
Dynamics should be able to handle many of the following types of queries in an interactive and contextualized manner:

+ Help (Eg. "*How do I use this?*" should display help information along with shortcuts to try basic searches).
+ Statistics (Eg. "*What is the population of Spain?*" should display the population of Spain over time, contextualized with the population of other neighboring countries).
+ Definitions (Eg. "*Define slapdash.*" should provide a dictionary definition along with easy access to synonyms and their definitions).
+ Real-time Data (Eg. "*What's the time?*" should provide a running clock that always provides an accurate time rather than a fixedf time that was only accurate when the query was made).
+ Events (Eg. "*When is Thanksgiving?*" should provide an interactive calender with the requested date displayed alongside the user's calendar events for that week or month).
+ Calculations (Eg. "*What is the square root of pi?*" should display not only a numerical answer but other helpful information like "trancendental number" or "non-real result").
+ Tasks (Eg. "*Convert PDF to JPG.*" should return a widget that can convert any uploaded PDF files to JPG images or images of various other file types -- from this, it is easy to see the power of returning a "tool" rather than just a link or individual answer).

etc. The key here is that answers should be user-contextualized and made interactive where possible to allow them to be more immediately useful to the user.

### Implementation
The engine will be accessed via an OpenFrameworks GUI written in C++. However, because the majority of the data needed to provide meaningful results will be accessed via web APIs, the actual "magic" of processing the user's query using NLP, searching for relevant results, and then building a contextualized widget will be implemented using a PHP backend with a MySQL database and HTML/CSS/JavaScript output. This result will then be rendered in OpenFrameworks using ofxAwesomiumPlus. The C++ application will also provide the implementation used for saving/bookmarking these results for later reference.
