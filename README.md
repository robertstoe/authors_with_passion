# Authors with Passion (Influencers)

This is a web application I did for a summer academy.

## The premise

#### Business requirements
A web solution that allows posting articles. Readers can vote each article and the vote will score for the author.

#### Functional requirements
Influencers will be an online application. 
Users see on the first page the snipet of the posted articles in the descending order of posting and clicking on an article will show the entire article and it should display the nickname of the author. 
The article list page will show for each article the title, a limited number of characters from the text, the nickname of the author and the date. 
Voting an article should be allowed only once from a computer and the score will be counted for the author. 
The solution will not require login for readers nor authors. 
A top menu should be shown to allow adding a new article or visualizing the ranking of the influencers. 
An article should have a title, content and tags

Some nice to have features would be: 
on the bottom of the article details page you can visualize snipets of articles of the same author or articles with the same tags. 
Voting can be done from both, list of articles page and article details page. 
Optionally you can add an image on an article. 
Edit your past articles (email can be used to uniquely identify the author and edit can be done by sending an email - with a link containing a unique identifier to prove access to the email). 
An article will not be allowed to be eddited after receiving a vote (to not change the meaning of the article after receiving votes)

## Built with

* [XAMPP](https://www.apachefriends.org/index.html) - Apache and MySQL distribution
* [DBeaver](https://dbeaver.io/) - Database manipulation
* [Symfony](https://symfony.com/) -  Web application framework

## What I have achieved so far

Must have: 
- [x] users see on the first page the snipet of the posted articles in the descending order of posting
- [x] clicking on an article will show the entire article and it should display the nickname of the author
- [x] the article list page will show for each article the title, a limited number of characters from the text, the nickname of the author and the date
- [x] voting an article should be allowed only once from a computer and the score will be counted for the author
- [x] the solution will not require login for readers nor authors.
- [x] a top menu should be shown to allow adding a new article or visualizing the ranking of the influencers.
- [x] an article should have a title, content and tags.

Nice to have: 
- [ ] on the bottom of the article details page you can visualize snipets of articles of the same author or articles with the same tags
- [ ] voting can be done from both, list of articles page and article details page
- [ ] Optionally you can add an image on an article
- [x] edit your past articles (email can be used to uniquely identify the author and edit can be done by sending an email - with a link containing a unique identifier to prove access to the email)
- [x] an article will not be allowed to be eddited after receiving a vote (to not change the meaning of the article after receiving votes)

Bonus:
- [x] search functionality after article title
- [ ] users able to add tags
- [ ] advanced searching
