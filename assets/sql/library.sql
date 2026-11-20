--
-- Base de données : `library` (en SQLite, la base correspond au fichier .sqlite / .db)
--

PRAGMA foreign_keys = ON;

-- --------------------------------------------------------

--
-- Structure de la table `authors`
--

DROP TABLE IF EXISTS `books`;
DROP TABLE IF EXISTS `authors`;

CREATE TABLE `authors` (
  `id` INTEGER PRIMARY KEY AUTOINCREMENT,
  `name` varchar(255) NOT NULL,
  `biography` text DEFAULT NULL
);

--
-- Déchargement des données de la table `authors`
--

INSERT INTO `authors` (`id`, `name`, `biography`) VALUES
(1, 'Marijn Haverbeke', 'Marijn Haverbeke is a programming language enthusiast and polyglot. He''s worked his way from trivial BASIC games on the Commodore, through a C++ phase, to the present where he mostly hacks on database systems and web APIs in dynamic languages. He recently won the JS1K—JavaScript demo in 1024 bytes—contest, and is the author of a wide range of open-source software'),
(2, 'Nicolás Bevacqua', 'Nicolas is a renowned JavaScript expert and the published author of JavaScript Application Design (Manning 2015), a book on JavaScript processes and quality design; and Practical Modern JavaScript (O''Reilly Media, 2017), a book on the ECMAScript specification. Besides writing books and articles for ponyfoo.com, he also likes giving conference talks and contributing to open-source'),
(3, 'Nicholas C. Zakas', 'Nicholas C. Zakas is a Web Software Engineer who specializes in user interface design and implementation for Web applications using JavaScript, Dynamic HTML, CSS, XML, and XSLT. He is currently principal front end engineer for the Yahoo! homepage and is a contributor to the Yahoo! User Interface (YUI) library, having written the Cookie Utility, Profiler, and YUI Tes'),
(4, 'Axel Rauschmayer', 'Dr. Axel Rauschmayer specializes in JavaScript and web development. He has written the Oâ€™Reilly book â€œSpeaking JavaScriptâ€, blogs at 2ality.com, is trainer for Ecmanauten and organizes the MunichJS user group. He also frequently holds talks and workshops at conferences'),
(5, 'Addy Osmani', 'Addy is an engineering manager with the Chrome team at Google working on Web Performance. His day-to-day job is leading a Speed team who focus on trying to get pages on the web loading and running smoothly. Our projects include Lighthouse and Workbox. Addyâ€™s written books including Essential JavaScript Design Patterns and the recent Essential Image Optimization guide at images.guide'),
(6, 'Kyle Simpson', 'Kyle Simpson likes to explore JS and FP techniques. He''s written books, taught, and spoken publicly. He''s currently helping build a culture of engineering excellence for his employer.'),
(7, 'Scott Chacon and Ben Straub', 'Scott Chacon is a Git evangelist and Ruby developer employed at Logical Awesome working on GitHub.com. He is the author of the Git Internals Peepcode PDF as well as the maintainer of the Git homepage and the Git Community Book. Scott has presented at RailsConf, RubyConf, Scotland on Rails, Ruby Kaigi, OSCON and a number of local groups and has done corporate training on Git across the country.'),
(8, 'Caitlin Sadowski, Thomas Zimmermann', 'Dr. Caitlin Sadowski is a software engineer at Google in Mountain View, California, where she aims to understand and improve developer workflows. Currently, she is helping Chrome developers make data-driven decisions as the manager of the Chrome Metrics team. In the past, she made static analysis useful at Google by creating the Tricorder program analysis platform, and then co-founded a team that provides ongoing insight into how developers spend their time and what makes them effective (the Engineering Productivity Research team). She has a PhD from the University of California at Santa Cruz where she worked on a variety of research topics related to programming languages, software engineering, and human computer interaction. She enjoys baking with her three-year-old, Naru.');

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

CREATE TABLE `books` (
  `id` INTEGER PRIMARY KEY AUTOINCREMENT,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `author_id` integer NOT NULL,
  `published` date NOT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `pages` integer NOT NULL,
  `description` text DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  CONSTRAINT `FK_books_author_id` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`)
);

--
-- Index pour la table `books`
--

CREATE INDEX `FK_books_author_id` ON `books` (`author_id`);

--
-- Déchargement des données de la table `books`
--

INSERT INTO `books` (`id`, `title`, `subtitle`, `author_id`, `published`, `publisher`, `pages`, `description`, `website`) VALUES
(1, 'Eloquent JavaScript, Third Edition', 'A Modern Introduction to Programming', 1, '2018-12-04', 'No Starch Press', 472, 'JavaScript lies at the heart of almost every modern web application, from social apps like Twitter to browser-based game frameworks like Phaser and Babylon. Though simple for beginners to pick up and play with, JavaScript is a flexible, complex language that you can use to build full-scale applications.', 'http://eloquentjavascript.net/'),
(2, 'Practical Modern JavaScript', 'Dive into ES6 and the Future of JavaScript', 2, '2017-07-16', 'O''Reilly Media', 334, 'To get the most out of modern JavaScript, you need learn the latest features of its parent specification, ECMAScript 6 (ES6). This book provides a highly practical look at ES6, without getting lost in the specification or its implementation details.', 'https://github.com/mjavascript/practical-modern-javascript'),
(3, 'Understanding ECMAScript 6', 'The Definitive Guide for JavaScript Developers', 3, '2016-09-03', 'No Starch Press', 352, 'ECMAScript 6 represents the biggest update to the core of JavaScript in the history of the language. In Understanding ECMAScript 6, expert developer Nicholas C. Zakas provides a complete guide to the object types, syntax, and other exciting changes that ECMAScript 6 brings to JavaScript.', 'https://leanpub.com/understandinges6/read'),
(4, 'Speaking JavaScript', 'An In-Depth Guide for Programmers', 4, '2014-04-08', 'O''Reilly Media', 460, 'Like it or not, JavaScript is everywhere these days -from browser to server to mobile- and now you, too, need to learn the language or dive deeper than you have. This concise book guides you into and through JavaScript, written by a veteran programmer who once found himself in the same position.', 'http://speakingjs.com/'),
(5, 'Learning JavaScript Design Patterns', 'A JavaScript and jQuery Developer''s Guide', 5, '2012-08-30', 'O''Reilly Media', 254, 'With Learning JavaScript Design Patterns, you''ll learn how to write beautiful, structured, and maintainable JavaScript by applying classical and modern design patterns to the language. If you want to keep your code efficient, more manageable, and up-to-date with the latest best practices, this book is for you.', 'http://www.addyosmani.com/resources/essentialjsdesignpatterns/book/'),
(6, 'You Don''t Know JS Yet', 'Get Started', 6, '2020-01-28', 'Independently published', 143, 'The worldwide best selling You Don''t Know JS book series is back for a 2nd edition: You Don''t Know JS Yet. All 6 books are brand new, rewritten to cover all sides of JS for 2020 and beyond.', 'https://github.com/getify/You-Dont-Know-JS/tree/2nd-ed/get-started'),
(7, 'Pro Git', 'Everything you neeed to know about Git', 7, '2014-11-18', 'Apress; 2nd edition', 458, 'Pro Git (Second Edition) is your fully-updated guide to Git and its usage in the modern world. Git has come a long way since it was first developed by Linus Torvalds for Linux kernel development. It has taken the open source world by storm since its inception in 2005, and this book teaches you how to use it like a pro.', 'https://git-scm.com/book/en/v2'),
(8, 'Rethinking Productivity in Software Engineering', '', 8, '2019-05-11', 'Apress', 310, 'Get the most out of this foundational reference and improve the productivity of your software teams. This open access book collects the wisdom of the 2017 ""Dagstuhl"" seminar on productivity in software engineering, a meeting of community leaders, who came together with the goal of rethinking traditional definitions and measures of productivity.', 'https://doi.org/10.1007/978-1-4842-4221-6');