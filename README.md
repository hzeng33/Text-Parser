# Web-Based-Text-Parser
This was a course project when taking CS355 at CUNY Queens College. A web-based parser of literary texts that also reports on the word frequencies of the texts being parsed. This has applications in general, but especially to the rising field known as "Digital Humanities"

It was deployed on the CS Dept server (Venus/Mars) at http://venus.cs.qc.cuny.edu/~zeha6333/cs355/ or another publicly accessible server with free or paid hosting. 

Step 1. In my MySQL database on the CS Dept. server, created these two tables, and the respective columns and constraints: 
        ●	source
        ○	source_id int auto_increment primary key not null
        ○	source_name varchar(40) not null
        ○	source_url varchar(255) not null
        ○	source_begin varchar(50) null
        ○	source_end varchar(50) null
        ○	parsed_dtm timestamp default current_timestamp

        ●	occurrence
        ○	occurrence_id int auto_increment primary key not null
        ○	source_id int not null foreign key references source(source_id)
        ○	word varchar(30) not null
        ○	freq int not null
   
Step 2. Created an HTML based parse screen with at least the following elements
        ●	Header with an appropriate header message
        ●	Caption and text box for "Source Name"
        ●	Caption and text box for "Source URL" (make it sufficiently large for a URL)
        ●	Caption and text box for "Source Begin"
        ●	Caption and text box for "Source End"
        ●	Submit button labeled "Parse"
        ●	HTML form wrapping all of the above (use POST method as some fields above will not make good URL parameters when submitting via GET)

Step 3. In PHP, wrote code that upon receiving the request from the form in Step 2, will 
        ●	Create a record in the source db table (see Task 1 for attributes to be recorded)
        ●	Obtain the text from that URL
        ●	If "Source Begin" and/or "Source Edn" were provided, restrict to the substring between them
        ●	Remove punctuation marks, but retain spaces as that is used to split the text into words.
        ●	Convert the word into all-caps
        ●	Split the text into a list of words
        ●	Using an associative array, determine the frequency of each word
        ●	Store the frequency of each word in the occurrence table, referencing the appropriate source_id

Step 4. Created a PHP page that generated the HTML with an appropriate page header and a table with appropriate column headings and these fields
        ●	source_id
        ●	source_name
        ●	source_url - is a hyperlink to the online text/page for that URL
        ●	source_begin
        ●	source_end
        ●	parsed_dtm
        ●	words - hyperlink to detailed report 

Step 5. Created a PHP page that generated the HTML with an appropriate page header with the name of the source and a table with appropriate column headings and these fields. The list should be sorted in decreasing order of frequency.
        ●	word
        ●	frequency
        ●	percentage - the percentage of words (100% * freq of word / total words in that source) 

