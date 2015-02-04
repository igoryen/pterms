create table term (
	id int(11) NOT NULL auto_increment,
    abbreviation 	varchar(100) not null,
    standsfor 		varchar(255) not null,
    explanation 	varchar(1000) null,
    example			varchar(1000) null,
    link			varchar(500) null,
    primary key (id)
);

INSERT INTO term (abbreviation, standsfor, explanation)
	values (
		'.htaccess',
        'hypertext access',
        'a directory-level configuration file supported by several web servers. It allows for decentralized management of web server configuration. They are placed inside the web tree, and are able to override a subset of the server\'s global configuration for the directory that they are in, and all sub-directories.[1]
The original purpose of .htaccess—reflected in its name—was to allow per-directory access control by, for example, requiring a password to access the content. More commonly, however, the .htaccess files override many other configuration settings such as content type, character set, CGI handlers, etc.
'
    );
    
INSERT INTO term (abbreviation, standsfor, explanation)
values (
		'A',
        'aliasing',
        'The ability to refer to an external fully qualified name with an alias, or importing. an important feature of namespaces. In PHP, accomplished with the use operator.'
    );
INSERT INTO term (abbreviation, standsfor, explanation)
values (    
    'AA',
    'associative array',
    'same as indexed array to PHP'
    );
    
    
INSERT INTO 
	term (
		abbreviation, 
		standsfor
        )
values (    
    'ALC',
    'application level controllers'
    );
    
    
INSERT INTO 
	term (
		abbreviation, 
		standsfor,
        explanation
        )
values (    
    'AP',
    'architectural pattern',
    'MVC is a high level AP'
    );