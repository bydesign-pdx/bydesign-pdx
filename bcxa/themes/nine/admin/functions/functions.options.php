<?php

add_action('init','of_options', 11);

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories = array();  
		$of_categories_obj = get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;
		}
		$categories_tmp = array_unshift($of_categories, "Select a category:");    

		//Access the WordPress Categories via an Array
		/*$of_slider_tax = array();  
		$of_slider_tax_obj = get_terms('slider', array('hide_empty' => 0));
		foreach ($of_slider_tax_obj as $of_tax) {
		    $of_slider_tax[$of_tax->slug] = $of_tax->name;
		}
		$tax_tmp = array_unshift($of_slider_tax, "select slider");*/
	       
		//Access the WordPress Pages via an Array
		$of_pages = array();
		$of_pages_obj = get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp = array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select 	= array("one","two","three","four","five"); 
		$of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 

		$font_sizes = array(
			"0" => "Select Size",
			'10' => '10',
			'11' => '11',
			'12' => '12',
			'13' => '13',
			'14' => '14',
			'15' => '15',
			'16' => '16',
			'17' => '17',
			'18' => '18',
			'19' => '19',
			'20' => '20',
			'21' => '21',
			'22' => '22',
			'23' => '23',
			'24' => '24',
			'25' => '25',
			'26' => '26',
			'27' => '27',
			'28' => '28',
			'29' => '29',
			'30' => '30',
			'31' => '31',
			'32' => '32',
			'33' => '33',
			'34' => '34',
			'35' => '35',
			'36' => '36',
			'37' => '37',
			'38' => '38',
			'39' => '39',
			'40' => '40',
			'41' => '41',
			'42' => '42',
		);

		$google_fonts = array(
			"0" => "Select Font",
			"Abel" => "Abel",
			"Abril Fatface" => "Abril Fatface",
			"Aclonica" => "Aclonica",
			"Acme" => "Acme",
			"Actor" => "Actor",
			"Adamina" => "Adamina",
			"Advent Pro" => "Advent Pro",
			"Aguafina Script" => "Aguafina Script",
			"Aladin" => "Aladin",
			"Aldrich" => "Aldrich",
			"Alegreya" => "Alegreya",
			"Alegreya SC" => "Alegreya SC",
			"Alex Brush" => "Alex Brush",
			"Alfa Slab One" => "Alfa Slab One",
			"Alice" => "Alice",
			"Alike" => "Alike",
			"Alike Angular" => "Alike Angular",
			"Allan" => "Allan",
			"Allerta" => "Allerta",
			"Allerta Stencil" => "Allerta Stencil",
			"Allura" => "Allura",
			"Almendra" => "Almendra",
			"Almendra SC" => "Almendra SC",
			"Amaranth" => "Amaranth",
			"Amatic SC" => "Amatic SC",
			"Amethysta" => "Amethysta",
			"Andada" => "Andada",
			"Andika" => "Andika",
			"Angkor" => "Angkor",
			"Annie Use Your Telescope" => "Annie Use Your Telescope",
			"Anonymous Pro" => "Anonymous Pro",
			"Antic" => "Antic",
			"Antic Didone" => "Antic Didone",
			"Antic Slab" => "Antic Slab",
			"Anton" => "Anton",
			"Arapey" => "Arapey",
			"Arbutus" => "Arbutus",
			"Architects Daughter" => "Architects Daughter",
			"Arimo" => "Arimo",
			"Arizonia" => "Arizonia",
			"Armata" => "Armata",
			"Artifika" => "Artifika",
			"Arvo" => "Arvo",
			"Asap" => "Asap",
			"Asset" => "Asset",
			"Astloch" => "Astloch",
			"Asul" => "Asul",
			"Atomic Age" => "Atomic Age",
			"Aubrey" => "Aubrey",
			"Audiowide" => "Audiowide",
			"Average" => "Average",
			"Averia Gruesa Libre" => "Averia Gruesa Libre",
			"Averia Libre" => "Averia Libre",
			"Averia Sans Libre" => "Averia Sans Libre",
			"Averia Serif Libre" => "Averia Serif Libre",
			"Bad Script" => "Bad Script",
			"Balthazar" => "Balthazar",
			"Bangers" => "Bangers",
			"Basic" => "Basic",
			"Battambang" => "Battambang",
			"Baumans" => "Baumans",
			"Bayon" => "Bayon",
			"Belgrano" => "Belgrano",
			"Belleza" => "Belleza",
			"Bentham" => "Bentham",
			"Berkshire Swash" => "Berkshire Swash",
			"Bevan" => "Bevan",
			"Bigshot One" => "Bigshot One",
			"Bilbo" => "Bilbo",
			"Bilbo Swash Caps" => "Bilbo Swash Caps",
			"Bitter" => "Bitter",
			"Black Ops One" => "Black Ops One",
			"Bokor" => "Bokor",
			"Bonbon" => "Bonbon",
			"Boogaloo" => "Boogaloo",
			"Bowlby One" => "Bowlby One",
			"Bowlby One SC" => "Bowlby One SC",
			"Brawler" => "Brawler",
			"Bree Serif" => "Bree Serif",
			"Bubblegum Sans" => "Bubblegum Sans",
			"Buda" => "Buda",
			"Buenard" => "Buenard",
			"Butcherman" => "Butcherman",
			"Butterfly Kids" => "Butterfly Kids",
			"Cabin" => "Cabin",
			"Cabin Condensed" => "Cabin Condensed",
			"Cabin Sketch" => "Cabin Sketch",
			"Caesar Dressing" => "Caesar Dressing",
			"Cagliostro" => "Cagliostro",
			"Calligraffitti" => "Calligraffitti",
			"Cambo" => "Cambo",
			"Candal" => "Candal",
			"Cantarell" => "Cantarell",
			"Cantata One" => "Cantata One",
			"Cardo" => "Cardo",
			"Carme" => "Carme",
			"Carter One" => "Carter One",
			"Caudex" => "Caudex",
			"Cedarville Cursive" => "Cedarville Cursive",
			"Ceviche One" => "Ceviche One",
			"Changa One" => "Changa One",
			"Chango" => "Chango",
			"Chau Philomene One" => "Chau Philomene One",
			"Chelsea Market" => "Chelsea Market",
			"Chenla" => "Chenla",
			"Cherry Cream Soda" => "Cherry Cream Soda",
			"Chewy" => "Chewy",
			"Chicle" => "Chicle",
			"Chivo" => "Chivo",
			"Coda" => "Coda",
			"Coda Caption" => "Coda Caption",
			"Codystar" => "Codystar",
			"Comfortaa" => "Comfortaa",
			"Coming Soon" => "Coming Soon",
			"Concert One" => "Concert One",
			"Condiment" => "Condiment",
			"Content" => "Content",
			"Contrail One" => "Contrail One",
			"Convergence" => "Convergence",
			"Cookie" => "Cookie",
			"Copse" => "Copse",
			"Corben" => "Corben",
			"Cousine" => "Cousine",
			"Coustard" => "Coustard",
			"Covered By Your Grace" => "Covered By Your Grace",
			"Crafty Girls" => "Crafty Girls",
			"Creepster" => "Creepster",
			"Crete Round" => "Crete Round",
			"Crimson Text" => "Crimson Text",
			"Crushed" => "Crushed",
			"Cuprum" => "Cuprum",
			"Cutive" => "Cutive",
			"Damion" => "Damion",
			"Dancing Script" => "Dancing Script",
			"Dangrek" => "Dangrek",
			"Dawning of a New Day" => "Dawning of a New Day",
			"Days One" => "Days One",
			"Delius" => "Delius",
			"Delius Swash Caps" => "Delius Swash Caps",
			"Delius Unicase" => "Delius Unicase",
			"Della Respira" => "Della Respira",
			"Devonshire" => "Devonshire",
			"Didact Gothic" => "Didact Gothic",
			"Diplomata" => "Diplomata",
			"Diplomata SC" => "Diplomata SC",
			"Doppio One" => "Doppio One",
			"Dorsa" => "Dorsa",
			"Dosis" => "Dosis",
			"Dr Sugiyama" => "Dr Sugiyama",
			"Droid Sans" => "Droid Sans",
			"Droid Sans Mono" => "Droid Sans Mono",
			"Droid Serif" => "Droid Serif",
			"Duru Sans" => "Duru Sans",
			"Dynalight" => "Dynalight",
			"EB Garamond" => "EB Garamond",
			"Eater" => "Eater",
			"Economica" => "Economica",
			"Electrolize" => "Electrolize",
			"Emblema One" => "Emblema One",
			"Emilys Candy" => "Emilys Candy",
			"Engagement" => "Engagement",
			"Enriqueta" => "Enriqueta",
			"Erica One" => "Erica One",
			"Esteban" => "Esteban",
			"Euphoria Script" => "Euphoria Script",
			"Ewert" => "Ewert",
			"Exo" => "Exo",
			"Expletus Sans" => "Expletus Sans",
			"Fanwood Text" => "Fanwood Text",
			"Fascinate" => "Fascinate",
			"Fascinate Inline" => "Fascinate Inline",
			"Federant" => "Federant",
			"Federo" => "Federo",
			"Felipa" => "Felipa",
			"Fjord One" => "Fjord One",
			"Flamenco" => "Flamenco",
			"Flavors" => "Flavors",
			"Fondamento" => "Fondamento",
			"Fontdiner Swanky" => "Fontdiner Swanky",
			"Forum" => "Forum",
			"Francois One" => "Francois One",
			"Fredericka the Great" => "Fredericka the Great",
			"Fredoka One" => "Fredoka One",
			"Freehand" => "Freehand",
			"Fresca" => "Fresca",
			"Frijole" => "Frijole",
			"Fugaz One" => "Fugaz One",
			"GFS Didot" => "GFS Didot",
			"GFS Neohellenic" => "GFS Neohellenic",
			"Galdeano" => "Galdeano",
			"Gentium Basic" => "Gentium Basic",
			"Gentium Book Basic" => "Gentium Book Basic",
			"Geo" => "Geo",
			"Geostar" => "Geostar",
			"Geostar Fill" => "Geostar Fill",
			"Germania One" => "Germania One",
			"Give You Glory" => "Give You Glory",
			"Glass Antiqua" => "Glass Antiqua",
			"Glegoo" => "Glegoo",
			"Gloria Hallelujah" => "Gloria Hallelujah",
			"Goblin One" => "Goblin One",
			"Gochi Hand" => "Gochi Hand",
			"Gorditas" => "Gorditas",
			"Goudy Bookletter 1911" => "Goudy Bookletter 1911",
			"Graduate" => "Graduate",
			"Gravitas One" => "Gravitas One",
			"Great Vibes" => "Great Vibes",
			"Gruppo" => "Gruppo",
			"Gudea" => "Gudea",
			"Habibi" => "Habibi",
			"Hammersmith One" => "Hammersmith One",
			"Handlee" => "Handlee",
			"Hanuman" => "Hanuman",
			"Happy Monkey" => "Happy Monkey",
			"Henny Penny" => "Henny Penny",
			"Herr Von Muellerhoff" => "Herr Von Muellerhoff",
			"Holtwood One SC" => "Holtwood One SC",
			"Homemade Apple" => "Homemade Apple",
			"Homenaje" => "Homenaje",
			"IM Fell DW Pica" => "IM Fell DW Pica",
			"IM Fell DW Pica SC" => "IM Fell DW Pica SC",
			"IM Fell Double Pica" => "IM Fell Double Pica",
			"IM Fell Double Pica SC" => "IM Fell Double Pica SC",
			"IM Fell English" => "IM Fell English",
			"IM Fell English SC" => "IM Fell English SC",
			"IM Fell French Canon" => "IM Fell French Canon",
			"IM Fell French Canon SC" => "IM Fell French Canon SC",
			"IM Fell Great Primer" => "IM Fell Great Primer",
			"IM Fell Great Primer SC" => "IM Fell Great Primer SC",
			"Iceberg" => "Iceberg",
			"Iceland" => "Iceland",
			"Imprima" => "Imprima",
			"Inconsolata" => "Inconsolata",
			"Inder" => "Inder",
			"Indie Flower" => "Indie Flower",
			"Inika" => "Inika",
			"Irish Grover" => "Irish Grover",
			"Istok Web" => "Istok Web",
			"Italiana" => "Italiana",
			"Italianno" => "Italianno",
			"Jim Nightshade" => "Jim Nightshade",
			"Jockey One" => "Jockey One",
			"Jolly Lodger" => "Jolly Lodger",
			"Josefin Sans" => "Josefin Sans",
			"Josefin Slab" => "Josefin Slab",
			"Judson" => "Judson",
			"Julee" => "Julee",
			"Junge" => "Junge",
			"Jura" => "Jura",
			"Just Another Hand" => "Just Another Hand",
			"Just Me Again Down Here" => "Just Me Again Down Here",
			"Kameron" => "Kameron",
			"Karla" => "Karla",
			"Kaushan Script" => "Kaushan Script",
			"Kelly Slab" => "Kelly Slab",
			"Kenia" => "Kenia",
			"Khmer" => "Khmer",
			"Knewave" => "Knewave",
			"Kotta One" => "Kotta One",
			"Koulen" => "Koulen",
			"Kranky" => "Kranky",
			"Kreon" => "Kreon",
			"Kristi" => "Kristi",
			"Krona One" => "Krona One",
			"La Belle Aurore" => "La Belle Aurore",
			"Lancelot" => "Lancelot",
			"Lato" => "Lato",
			"League Script" => "League Script",
			"Leckerli One" => "Leckerli One",
			"Ledger" => "Ledger",
			"Lekton" => "Lekton",
			"Lemon" => "Lemon",
			"Lilita One" => "Lilita One",
			"Limelight" => "Limelight",
			"Linden Hill" => "Linden Hill",
			"Lobster" => "Lobster",
			"Lobster Two" => "Lobster Two",
			"Londrina Outline" => "Londrina Outline",
			"Londrina Shadow" => "Londrina Shadow",
			"Londrina Sketch" => "Londrina Sketch",
			"Londrina Solid" => "Londrina Solid",
			"Lora" => "Lora",
			"Love Ya Like A Sister" => "Love Ya Like A Sister",
			"Loved by the King" => "Loved by the King",
			"Lovers Quarrel" => "Lovers Quarrel",
			"Luckiest Guy" => "Luckiest Guy",
			"Lusitana" => "Lusitana",
			"Lustria" => "Lustria",
			"Macondo" => "Macondo",
			"Macondo Swash Caps" => "Macondo Swash Caps",
			"Magra" => "Magra",
			"Maiden Orange" => "Maiden Orange",
			"Mako" => "Mako",
			"Marck Script" => "Marck Script",
			"Marko One" => "Marko One",
			"Marmelad" => "Marmelad",
			"Marvel" => "Marvel",
			"Mate" => "Mate",
			"Mate SC" => "Mate SC",
			"Maven Pro" => "Maven Pro",
			"Meddon" => "Meddon",
			"MedievalSharp" => "MedievalSharp",
			"Medula One" => "Medula One",
			"Megrim" => "Megrim",
			"Merienda One" => "Merienda One",
			"Merriweather" => "Merriweather",
			"Metal" => "Metal",
			"Metamorphous" => "Metamorphous",
			"Metrophobic" => "Metrophobic",
			"Michroma" => "Michroma",
			"Miltonian" => "Miltonian",
			"Miltonian Tattoo" => "Miltonian Tattoo",
			"Miniver" => "Miniver",
			"Miss Fajardose" => "Miss Fajardose",
			"Modern Antiqua" => "Modern Antiqua",
			"Molengo" => "Molengo",
			"Monofett" => "Monofett",
			"Monoton" => "Monoton",
			"Monsieur La Doulaise" => "Monsieur La Doulaise",
			"Montaga" => "Montaga",
			"Montez" => "Montez",
			"Montserrat" => "Montserrat",
			"Moul" => "Moul",
			"Moulpali" => "Moulpali",
			"Mountains of Christmas" => "Mountains of Christmas",
			"Mr Bedfort" => "Mr Bedfort",
			"Mr Dafoe" => "Mr Dafoe",
			"Mr De Haviland" => "Mr De Haviland",
			"Mrs Saint Delafield" => "Mrs Saint Delafield",
			"Mrs Sheppards" => "Mrs Sheppards",
			"Muli" => "Muli",
			"Mystery Quest" => "Mystery Quest",
			"Neucha" => "Neucha",
			"Neuton" => "Neuton",
			"News Cycle" => "News Cycle",
			"Niconne" => "Niconne",
			"Nixie One" => "Nixie One",
			"Nobile" => "Nobile",
			"Nokora" => "Nokora",
			"Norican" => "Norican",
			"Nosifer" => "Nosifer",
			"Nothing You Could Do" => "Nothing You Could Do",
			"Noticia Text" => "Noticia Text",
			"Nova Cut" => "Nova Cut",
			"Nova Flat" => "Nova Flat",
			"Nova Mono" => "Nova Mono",
			"Nova Oval" => "Nova Oval",
			"Nova Round" => "Nova Round",
			"Nova Script" => "Nova Script",
			"Nova Slim" => "Nova Slim",
			"Nova Square" => "Nova Square",
			"Numans" => "Numans",
			"Nunito" => "Nunito",
			"Odor Mean Chey" => "Odor Mean Chey",
			"Old Standard TT" => "Old Standard TT",
			"Oldenburg" => "Oldenburg",
			"Oleo Script" => "Oleo Script",
			"Open Sans" => "Open Sans",
			"Open Sans Condensed" => "Open Sans Condensed",
			"Orbitron" => "Orbitron",
			"Original Surfer" => "Original Surfer",
			"Oswald" => "Oswald",
			"Over the Rainbow" => "Over the Rainbow",
			"Overlock" => "Overlock",
			"Overlock SC" => "Overlock SC",
			"Ovo" => "Ovo",
			"Oxygen" => "Oxygen",
			"PT Mono" => "PT Mono",
			"PT Sans" => "PT Sans",
			"PT Sans Caption" => "PT Sans Caption",
			"PT Sans Narrow" => "PT Sans Narrow",
			"PT Serif" => "PT Serif",
			"PT Serif Caption" => "PT Serif Caption",
			"Pacifico" => "Pacifico",
			"Parisienne" => "Parisienne",
			"Passero One" => "Passero One",
			"Passion One" => "Passion One",
			"Patrick Hand" => "Patrick Hand",
			"Patua One" => "Patua One",
			"Paytone One" => "Paytone One",
			"Permanent Marker" => "Permanent Marker",
			"Petrona" => "Petrona",
			"Philosopher" => "Philosopher",
			"Piedra" => "Piedra",
			"Pinyon Script" => "Pinyon Script",
			"Plaster" => "Plaster",
			"Play" => "Play",
			"Playball" => "Playball",
			"Playfair Display" => "Playfair Display",
			"Podkova" => "Podkova",
			"Poiret One" => "Poiret One",
			"Poller One" => "Poller One",
			"Poly" => "Poly",
			"Pompiere" => "Pompiere",
			"Pontano Sans" => "Pontano Sans",
			"Port Lligat Sans" => "Port Lligat Sans",
			"Port Lligat Slab" => "Port Lligat Slab",
			"Prata" => "Prata",
			"Preahvihear" => "Preahvihear",
			"Press Start 2P" => "Press Start 2P",
			"Princess Sofia" => "Princess Sofia",
			"Prociono" => "Prociono",
			"Prosto One" => "Prosto One",
			"Puritan" => "Puritan",
			"Quantico" => "Quantico",
			"Quattrocento" => "Quattrocento",
			"Quattrocento Sans" => "Quattrocento Sans",
			"Questrial" => "Questrial",
			"Quicksand" => "Quicksand",
			"Qwigley" => "Qwigley",
			"Radley" => "Radley",
			"Raleway" => "Raleway",
			"Rammetto One" => "Rammetto One",
			"Rancho" => "Rancho",
			"Rationale" => "Rationale",
			"Redressed" => "Redressed",
			"Reenie Beanie" => "Reenie Beanie",
			"Revalia" => "Revalia",
			"Ribeye" => "Ribeye",
			"Ribeye Marrow" => "Ribeye Marrow",
			"Righteous" => "Righteous",
			"Rochester" => "Rochester",
			"Rock Salt" => "Rock Salt",
			"Rokkitt" => "Rokkitt",
			"Ropa Sans" => "Ropa Sans",
			"Rosario" => "Rosario",
			"Rosarivo" => "Rosarivo",
			"Rouge Script" => "Rouge Script",
			"Ruda" => "Ruda",
			"Ruge Boogie" => "Ruge Boogie",
			"Ruluko" => "Ruluko",
			"Ruslan Display" => "Ruslan Display",
			"Russo One" => "Russo One",
			"Ruthie" => "Ruthie",
			"Sail" => "Sail",
			"Salsa" => "Salsa",
			"Sancreek" => "Sancreek",
			"Sansita One" => "Sansita One",
			"Sarina" => "Sarina",
			"Satisfy" => "Satisfy",
			"Schoolbell" => "Schoolbell",
			"Seaweed Script" => "Seaweed Script",
			"Sevillana" => "Sevillana",
			"Shadows Into Light" => "Shadows Into Light",
			"Shadows Into Light Two" => "Shadows Into Light Two",
			"Shanti" => "Shanti",
			"Share" => "Share",
			"Shojumaru" => "Shojumaru",
			"Short Stack" => "Short Stack",
			"Siemreap" => "Siemreap",
			"Sigmar One" => "Sigmar One",
			"Signika" => "Signika",
			"Signika Negative" => "Signika Negative",
			"Simonetta" => "Simonetta",
			"Sirin Stencil" => "Sirin Stencil",
			"Six Caps" => "Six Caps",
			"Slackey" => "Slackey",
			"Smokum" => "Smokum",
			"Smythe" => "Smythe",
			"Sniglet" => "Sniglet",
			"Snippet" => "Snippet",
			"Sofia" => "Sofia",
			"Sonsie One" => "Sonsie One",
			"Sorts Mill Goudy" => "Sorts Mill Goudy",
			"Special Elite" => "Special Elite",
			"Spicy Rice" => "Spicy Rice",
			"Spinnaker" => "Spinnaker",
			"Spirax" => "Spirax",
			"Squada One" => "Squada One",
			"Stardos Stencil" => "Stardos Stencil",
			"Stint Ultra Condensed" => "Stint Ultra Condensed",
			"Stint Ultra Expanded" => "Stint Ultra Expanded",
			"Stoke" => "Stoke",
			"Sue Ellen Francisco" => "Sue Ellen Francisco",
			"Sunshiney" => "Sunshiney",
			"Supermercado One" => "Supermercado One",
			"Suwannaphum" => "Suwannaphum",
			"Swanky and Moo Moo" => "Swanky and Moo Moo",
			"Syncopate" => "Syncopate",
			"Tangerine" => "Tangerine",
			"Taprom" => "Taprom",
			"Telex" => "Telex",
			"Tenor Sans" => "Tenor Sans",
			"The Girl Next Door" => "The Girl Next Door",
			"Tienne" => "Tienne",
			"Tinos" => "Tinos",
			"Titan One" => "Titan One",
			"Trade Winds" => "Trade Winds",
			"Trocchi" => "Trocchi",
			"Trochut" => "Trochut",
			"Trykker" => "Trykker",
			"Tulpen One" => "Tulpen One",
			"Ubuntu" => "Ubuntu",
			"Ubuntu Condensed" => "Ubuntu Condensed",
			"Ubuntu Mono" => "Ubuntu Mono",
			"Ultra" => "Ultra",
			"Uncial Antiqua" => "Uncial Antiqua",
			"UnifrakturCook" => "UnifrakturCook",
			"UnifrakturMaguntia" => "UnifrakturMaguntia",
			"Unkempt" => "Unkempt",
			"Unlock" => "Unlock",
			"Unna" => "Unna",
			"VT323" => "VT323",
			"Varela" => "Varela",
			"Varela Round" => "Varela Round",
			"Vast Shadow" => "Vast Shadow",
			"Vibur" => "Vibur",
			"Vidaloka" => "Vidaloka",
			"Viga" => "Viga",
			"Voces" => "Voces",
			"Volkhov" => "Volkhov",
			"Vollkorn" => "Vollkorn",
			"Voltaire" => "Voltaire",
			"Waiting for the Sunrise" => "Waiting for the Sunrise",
			"Wallpoet" => "Wallpoet",
			"Walter Turncoat" => "Walter Turncoat",
			"Wellfleet" => "Wellfleet",
			"Wire One" => "Wire One",
			"Yanone Kaffeesatz" => "Yanone Kaffeesatz",
			"Yellowtail" => "Yellowtail",
			"Yeseva One" => "Yeseva One",
			"Yesteryear" => "Yesteryear",
			"Zeyada" => "Zeyada",
		);


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();

/* General
-------------------------------------------------------------------------------------------------------------------*/

$of_options[] = array( 	"name" 		=> "General",
						"type" 		=> "heading"
				);

$of_options[] = array( "name" => "Layout",
					"desc" => "",
					"id" => "layout",
					"std" => "l-boxed",
					"type" => "select",
					"options" => array("l-boxed" => "boxed", "l-wide" => "wide"));  

$of_options[] = array( "name" => "Disable Comments for all Pages (not Blog)",
					"desc" => "<strong>Be careful:</strong> Page specific Settings get overwritten.",
					"id" => "check_disablecomments",
					"std" => 1,
					"type" => "checkbox");
					
$of_options[] = array( "name" => "Favicon Upload (16x16)",
					"desc" => "Upload your Favicon (16x16 pixels ico/png - use <a href='http://www.favicon.cc/' target='_blank'>favicon.cc</a> to make sure it's fully compatible)",
					"id" => "media_favicon",
					"std" => "[site_url]/wp-content/themes/nine/framework/img/favicon.png",
					"mod" => "min",
					"type" => "media");
					
$of_options[] = array( "name" => "Apple iPhone Icon Upload (57x57)",
					"desc" => "Upload your Apple Touch Icon (57x57 pixels png)",
					"id" => "media_favicon_iphone",
					"std" => "[site_url]/wp-content/themes/nine/framework/img/favicon-mobile.png",
					"mod" => "min",
					"type" => "media");
					
$of_options[] = array( "name" => "Apple iPad Icon Upload (72x72)",
					"desc" => "Upload your Apple Touch Retina Icon (144x144 pixels png)",
					"id" => "media_favicon_ipad",
					"std" => "[site_url]/wp-content/themes/nine/framework/img/favicon-tablet.png",
					"mod" => "min",
					"type" => "media");

/*$of_options[] = array( "name" => "Responsive Design",
					"desc" => "Use the responsive design features.",
					"id" => "responsive",
					"std" => 1,
					"type" => "checkbox");*/

$of_options[] = array( "name" => "Tracking Code",
					"desc" => "Paste your Google Analytics Code (or other) here.",
					"id" => "textarea_trackingcode",
					"std" => "",
					"type" => "textarea"); 

$of_options[] = array( "name" => "Custom CSS",
					"desc" => "For small CSS snippets.",
					"id" => "textarea_custom_css",
					"std" => "",
					"type" => "textarea"); 

/* Headers
-------------------------------------------------------------------------------------------------------------------*/

$of_options[] = array( 	"name" 		=> "Header",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "Headers",
						"desc" 		=> "",
						"id" 		=> "introduction1",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Headers</h3>
										Pick one of 5 headers and customize them with options.",
						"icon" 		=> true,
						"type" 		=> "info"
				);


$of_options[] = array( 	"name" 		=> "Header Layout",
						"id" 		=> "header_layout",
						"std" 		=> "1",
						"type" => "images",
						"options" => array(
							"1" => get_bloginfo('template_directory')."/admin/assets/images/headers/h1.jpg",
							"2" => get_bloginfo('template_directory')."/admin/assets/images/headers/h2.jpg",
							"3" => get_bloginfo('template_directory')."/admin/assets/images/headers/h3.jpg",
							"4" => get_bloginfo('template_directory')."/admin/assets/images/headers/h4.jpg",
							"5" => get_bloginfo('template_directory')."/admin/assets/images/headers/h5.jpg"
						)
				);

$of_options[] = array( "name" => "Sticky Navigation",
					"desc" => "",
					"id" => "sticky_nav",
					"std" => 1,
					"type" => "checkbox");

$of_options[] = array( "name" => "Logo",
					"desc" 		=> "Please ",
					"desc" => "When you prepare your logo, please make sure it has the same height, as the 'Header Height' below. If its not, then just open Photoshop (or other graphic editor), create a new canvas with the width of your logo, and the height on the header, and put your logo image in the center of that canvas and save.",
					"id" => "logo",
					// Use the shortcodes [site_url] or [site_url_secure] for setting default URLs
					"std" => "",
					"type" => "media");

$of_options[] = array( "name" 	=> "Header Height",
					"desc" 		=> "Header height in pixels (number only). Default: 111",
					"id" 		=> "header_height",
					"std" 		=> 111,
					"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "Social Icons",
						"desc" 		=> "Eanble of disable social icons. Note: header #2 do no use social icons at all.",
						"id" 		=> "header_social_icons",
						"on" 		=> "Enable",
						"off" 		=> "Disable",
						"std" 		=> 1,
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> "Slogan",
						"desc" 		=> "The text will be displayes near the logo. Note: header #1 don't display this text.",
						"id" 		=> "logo_slogan",
						"std" 		=> "It's time to impress your visitors",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "Top Bar Text",
						"desc" 		=> "This text will be desplayed in the top bar.",
						"id" 		=> "bar_text",
						"std" 		=> "Call Us Anytime!",
						"type" 		=> "text"
				);


/* Footer
-------------------------------------------------------------------------------------------------------------------*/

$of_options[] = array( "name" => "Footer",
					"type" => "heading");

$of_options[] = array( 	"name" 		=> "Footer Configuration",
						"desc" 		=> "",
						"id" 		=> "introduction3",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Footer Configuration</h3>
										With these options you can achieve any footer configutation. Setup from 1 to 4 widget areas each with different width. <strong>Note:</strong> always use the 'Footer Widgets Column 4' option.",
						"icon" 		=> true,
						"type" 		=> "info"
				);
					
$of_options[] = array( "name" => "Enable Widgetized Footer",
					"desc" => "Check to show widgetized footer.",
					"id" => "check_footer_widgets",
					"std" => 1,
					"type" => "checkbox");

$of_options[] = array( "name" => "Footer Widgets Column 1",
					"desc" => "Select Footer widgets column width or disable.",
					"id" => "footer_column_one",
					"std" => "25%",
					"type" => "select",
					"options" => array("span3" => "25%","span4" => "33%","span6" => "50%","span8" => "66%","span9" => "75%","span12" => "100%","0" => "disabled")
					);

$of_options[] = array( "name" => "Footer Widgets Column 2",
					"desc" => "Select Footer widgets column width or disable.",
					"id" => "footer_column_two",
					"std" => "25%",
					"type" => "select",
					"options" => array("span3" => "25%","span4" => "33%","span6" => "50%","span8" => "66%","span9" => "75%","span12" => "100%","0" => "disabled")
					);

$of_options[] = array( "name" => "Footer Widgets Column 3",
					"desc" => "Select Footer widgets column width or disable.",
					"id" => "footer_column_three",
					"std" => "25%",
					"type" => "select",
					"options" => array("span3" => "25%","span4" => "33%","span6" => "50%","span8" => "66%","span9" => "75%","span12" => "100%","0" => "disabled")
					);

$of_options[] = array( "name" => "Footer Widgets Column 4",
					"desc" => "Select Footer widgets column width or disable.",
					"id" => "footer_column_four",
					"std" => "25%",
					"type" => "select",
					"options" => array("span3" => "25%","span4" => "33%","span6" => "50%","span8" => "66%","span9" => "75%","span12" => "100%","0" => "disabled")
					);

$of_options[] = array( "name" => "First Column Accent Color",
					"desc" => "Check if you want to style the first folumn to have accent background color.",
					"id" => "first_col_accent",
					"std" => 1,
					"type" => "checkbox");

$of_options[] = array( "name" => "Copyright Text",
					"desc" => "Enter your Copyright Text (HTML allowed)",
					"id" => "textarea_copyright",
					"std" => "&copy; Copyright 2012. Powered by <a href=\"http://wordpress.org/\">WordPress</a>",
					"type" => "textarea"); 


/* BG Options
-------------------------------------------------------------------------------------------------------------------*/


$of_options[] = array( "name" => "Background",
					"type" => "heading");

$of_options[] = array( "name" => "Background Image",
					"desc" => "Please choose an image or insert an image url to use for the backgroud.",
					"id" => "bg_image",
					"std" => "",
					"type" => "upload");

$of_options[] = array( "name" => "100% Background Image",
					"desc" => "Have background image always at 100% in width and height and scale according to the browser size.",
					"id" => "bg_full",
					"std" => 0,
					"type" => "checkbox");

$of_options[] = array( "name" => "Background Repeat",
					"desc" => "",
					"id" => "bg_repeat",
					"std" => "",
					"type" => "select",
					"options" => array('repeat' => 'repeat', 'repeat-x' => 'repeat-x', 'repeat-y' => 'repeat-y', 'no-repeat' => 'no-repeat'));  

$of_options[] = array( "name" =>  "Background Color",
					"desc" => "Pick a background color.",
					"id" => "bg_color",
					"std" => "",
					"type" => "color");


/* BG Options
-------------------------------------------------------------------------------------------------------------------*/


$of_options[] = array( "name" => "Typography",
					"type" => "heading");

$of_options[] = array( "name" => "Google Fonts",
					"desc" => "",
					"id" => "google_fonts_intro",
					"std" => "<h3 style='margin: 0;''>Google Fonts</h3>",
					"icon" => true,
					"type" => "info");

$of_options[] = array( "name" => "Select Body Font Family",
					"desc" => "Select a font family for body text",
					"id" => "google_body",
					"std" => "",
					"type" => "select",
					"options" => $google_fonts);

$of_options[] = array( "name" => "Select Menu Font",
					"desc" => "Select a font family for navigation",
					"id" => "google_menu",
					"std" => "",
					"type" => "select",
					"options" => $google_fonts);

$of_options[] = array( "name" => "Select Headings Font",
					"desc" => "Select a font family for headings",
					"id" => "google_heading",
					"std" => "",
					"type" => "select",
					"options" => $google_fonts);

$of_options[] = array( "name" => "Standard Fonts",
					"desc" => "",
					"id" => "standard_fonts_intro",
					"std" => "<h3 style='margin: 0; margin-bottom:10px;''>Standards</h3>If you have a Google Font selected above, it will override the standard font.",
					"icon" => true,
					"type" => "info");

$standard_fonts = array(
						'0' => 'Select Font',
						'Arial, Helvetica, sans-serif' => 'Arial, Helvetica, sans-serif',
						"'Arial Black', Gadget, sans-serif" => "'Arial Black', Gadget, sans-serif",
						"'Bookman Old Style', serif" => "'Bookman Old Style', serif",
						"'Comic Sans MS', cursive" => "'Comic Sans MS', cursive",
						"Courier, monospace" => "Courier, monospace",
						"Garamond, serif" => "Garamond, serif",
						"Georgia, serif" => "Georgia, serif",
						"Impact, Charcoal, sans-serif" => "Impact, Charcoal, sans-serif",
						"'Lucida Console', Monaco, monospace" => "'Lucida Console', Monaco, monospace",
						"'Lucida Sans Unicode', 'Lucida Grande', sans-serif" => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
						"'MS Sans Serif', Geneva, sans-serif" => "'MS Sans Serif', Geneva, sans-serif",
						"'MS Serif', 'New York', sans-serif" => "'MS Serif', 'New York', sans-serif",
						"'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
						"Tahoma, Geneva, sans-serif" => "Tahoma, Geneva, sans-serif",
						"'Times New Roman', Times, serif" => "'Times New Roman', Times, serif",
						"'Trebuchet MS', Helvetica, sans-serif" => "'Trebuchet MS', Helvetica, sans-serif",
						"Verdana, Geneva, sans-serif" => "Verdana, Geneva, sans-serif"
					);

$of_options[] = array( "name" => "Select Body Font Family",
					"desc" => "Select a font family for body text",
					"id" => "standard_body",
					"std" => "",
					"type" => "select",
					"options" => $standard_fonts);

$of_options[] = array( "name" => "Select Menu Font Family",
					"desc" => "Select a font family for menu / navigation",
					"id" => "standard_menu",
					"std" => "",
					"type" => "select",
					"options" => $standard_fonts);

$of_options[] = array( "name" => "Select Headings Font Family",
					"desc" => "Select a font family for headings",
					"id" => "standard_heading",
					"std" => "",
					"type" => "select",
					"options" => $standard_fonts);

$of_options[] = array( "name" => "Standard Fonts",
					"desc" => "",
					"id" => "font_size_intro",
					"std" => "<h3 style='margin: 0;'>Font Sizes</h3>",
					"icon" => true,
					"type" => "info");

$of_options[] = array( "name" => "Body Font Size (px)",
					"desc" => "Default is 13",
					"id" => "body_font_size",
					"std" => "13",
					"type" => "select",
					"options" => $font_sizes);

$of_options[] = array( "name" => "Main Nav Font Size (px)",
					"desc" => "Default is 24",
					"id" => "nav_font_size",
					"std" => "24",
					"type" => "select",
					"options" => $font_sizes);

$of_options[] = array( "name" => "Heading Font Size H1 (px)",
					"desc" => "Default is 40",
					"id" => "h1_font_size",
					"std" => "40",
					"type" => "select",
					"options" => $font_sizes);

$of_options[] = array( "name" => "Heading Font Size H2 (px)",
					"desc" => "Default is 28",
					"id" => "h2_font_size",
					"std" => "28",
					"type" => "select",
					"options" => $font_sizes);

$of_options[] = array( "name" => "Heading Font Size H3 (px)",
					"desc" => "Default is 24",
					"id" => "h3_font_size",
					"std" => "24",
					"type" => "select",
					"options" => $font_sizes);

$of_options[] = array( "name" => "Heading Font Size H4 (px)",
					"desc" => "Default is 22",
					"id" => "h4_font_size",
					"std" => "22",
					"type" => "select",
					"options" => $font_sizes);

$of_options[] = array( "name" => "Heading Font Size H5 (px)",
					"desc" => "Default is 20",
					"id" => "h5_font_size",
					"std" => "20",
					"type" => "select",
					"options" => $font_sizes);

$of_options[] = array( "name" => "Heading Font Size H6 (px)",
					"desc" => "Default is 18",
					"id" => "h6_font_size",
					"std" => "18",
					"type" => "select",
					"options" => $font_sizes);


/* Styling Options
-------------------------------------------------------------------------------------------------------------------*/

$of_options[] = array( "name" => "Styling",
					"type" => "heading");

/*$of_options[] = array( "name" => "Content Elements",
					"desc" => "",
					"id" => "custom_color_scheme_intro",
					"std" => "<h3 style='margin: 0;'>Content Elements</h3>",
					"icon" => true,
					"type" => "info");

$of_options[] = array( "name" =>  "Body Text",
					"desc" => "Default: #999999",
					"id" => "body_text_color",
					"std" => "#999999",
					"type" => "color");

$of_options[] = array( "name" =>  "Main Menu",
					"desc" => "Default: #676767",
					"id" => "main_menu_color",
					"std" => "#676767",
					"type" => "color");

$of_options[] = array( "name" =>  "Headings Color",
					"desc" => "Default: #676767",
					"id" => "headings_color",
					"std" => "#676767",
					"type" => "color");

*/


$of_options[] = array( "name" => "Accent Color Group #1",
					"desc" => "",
					"id" => "custom_color_scheme_intro",
					"std" => "<h3 style='margin: 0;'>Accent Color Group #1</h3>
							This is the main accent color of the theme.",
					"icon" => true,
					"type" => "info");

$of_options[] = array( "name" =>  "Accent Color #1",
					"desc" => "Default: #1bc4de",
					"id" => "accent_1",
					"std" => "#1bc4de",
					"type" => "color");

$of_options[] = array( "name" =>  "Accent #1 Text",
					"desc" => "Default: #ffffff",
					"id" => "accent_1_text",
					"std" => "#ffffff",
					"type" => "color");




$of_options[] = array( "name" => "Accent Color Group #2",
					"desc" => "",
					"id" => "custom_color_scheme_intro",
					"std" => "<h3 style='margin: 0;'>Accent Color Group #2</h3>
							This color mainly used in the footer.",
					"icon" => true,
					"type" => "info");

$of_options[] = array( "name" =>  "Accent Color #2",
					"desc" => "Default: #32363E",
					"id" => "accent_2",
					"std" => "#32363E",
					"type" => "color");

$of_options[] = array( "name" =>  "Accent Color #2 Darker",
					"desc" => "Default: #25272D",
					"id" => "accent_2_darker",
					"std" => "#25272D",
					"type" => "color");

$of_options[] = array( "name" =>  "Accent Color #2 Lighter",
					"desc" => "Default: #454953",
					"id" => "accent_2_lighter",
					"std" => "#454953",
					"type" => "color");

$of_options[] = array( "name" =>  "Accent #2 Headings",
					"desc" => "Default: #ffffff",
					"id" => "accent_2_headings",
					"std" => "#ffffff",
					"type" => "color");

$of_options[] = array( "name" =>  "Accent #2 Text",
					"desc" => "Default: #999999",
					"id" => "accent_2_text",
					"std" => "#999999",
					"type" => "color");

$of_options[] = array( "name" =>  "Accent #2 Link",
					"desc" => "Default: #ffffff",
					"id" => "accent_2_link",
					"std" => "#ffffff",
					"type" => "color");



/* Slider
-------------------------------------------------------------------------------------------------------------------*/

$of_options[] = array( 	"name" 		=> "Flex Slider",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "Slider Settings",
						"desc" 		=> "",
						"id" 		=> "introduction1",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Slider Settings</h3>
										These setting will apply to all Flex Sliders on your website.",
						"icon" 		=> true,
						"type" 		=> "info"
				);

$of_options[] = array( 	"name" 		=> "Slider Speed",
						"desc" 		=> "Pause between slides change. Default: 6.",
						"id" 		=> "slider_speed",
						"std" 		=> "6",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "20",
						"type" 		=> "sliderui" 
				);

$of_options[] = array( 	"name" 		=> "Animation Speed",
						"desc" 		=> "Slide change effect speed in milliseconds. Default: 800.",
						"id" 		=> "slider_effect_speed",
						"std" 		=> "800",
						"min" 		=> "100",
						"step"		=> "100",
						"max" 		=> "3000",
						"type" 		=> "sliderui" 
				);


/* Blog
-------------------------------------------------------------------------------------------------------------------*/

$of_options[] = array( 	"name" 		=> "Blog",
						"type" 		=> "heading"
				);
					
$of_options[] = array( "name" => "Blog Layout",
					"id" => "blog_layout",
					"std" => "full",
					"type" => "select",
					"options" => array('full', 'medium'));	
					
$of_options[] = array( "name" => "Enable Share-Box on Post Detail",
					"desc" => "Check to enable Share-Box",
					"id" => "check_sharebox",
					"std" => 1,
					"type" => "checkbox"); 
					
$of_options[] = array( "name" => "Blog Excerpt Length",
					"desc" => "Default: 55. Used for blog page, archives & search results.",
					"id" => "text_excerptlength",
					"std" => "55",
					"type" => "text"); 
					
$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => "Blog Title Settings",
					"icon" => false,
					"type" => "info"); 
					
$of_options[] = array( "name" => "Blog Title",
					"desc" => "",
					"id" => "text_blogtitle",
					"std" => "Blog",
					"type" => "text");

$of_options[] = array( "name" => "Blog Subtitle",
					"desc" => "",
					"id" => "text_blogsubtitle",
					"std" => "Blog Subtitle",
					"type" => "text"); 
					

$of_options[] = array( "name" => "Blog Breadcrumb Name",
					"desc" => "",
					"id" => "text_blogbreadcrumb",
					"std" => "Blog",
					"type" => "text"); 	
					
$of_options[] = array( "name" => "Blog Titlebar",
					"desc" => "Choose your Blog Titlebar Layout",
					"id" => "select_blogtitlebar",
					"std" => "Title + Subtitle",
					"type" => "select",
					"options" => array('Title + Subtitle', 'Title + Breadcrumbs', 'No Titlebar'));

$of_options[] = array( "name" => "Disable Breadcrumbs for Blog",
					"desc" => "Check to disable Breadcrumbs for Blog & Blog Posts.",
					"id" => "check_blogbreadcrumbs",
					"std" => 0,
					"type" => "checkbox");		

$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => "Social Sharing Box Icons",
					"icon" => false,
					"type" => "info"); 
					
$of_options[] = array( "name" => "Enable Facebook in Social Sharing Box",
					"desc" => "Check to enable Facebook in Social Sharing Box",
					"id" => "check_sharingboxfacebook",
					"std" => 1,
					"type" => "checkbox"); 
					
$of_options[] = array( "name" => "Enable Twitter in Social Sharing Box",
					"desc" => "Check to enable Twitter in Social Sharing Box",
					"id" => "check_sharingboxtwitter",
					"std" => 1,
					"type" => "checkbox"); 
					
$of_options[] = array( "name" => "Enable LinkedIn in Social Sharing Box",
					"desc" => "Check to enable LinkedIn in Social Sharing Box",
					"id" => "check_sharingboxlinkedin",
					"std" => 1,
					"type" => "checkbox"); 
					
$of_options[] = array( "name" => "Enable Reddit in Social Sharing Box",
					"desc" => "Check to enable Reddit in Social Sharing Box",
					"id" => "check_sharingboxreddit",
					"std" => 1,
					"type" => "checkbox"); 
					
$of_options[] = array( "name" => "Enable Digg in Social Sharing Box",
					"desc" => "Check to enable Digg in Social Sharing Box",
					"id" => "check_sharingboxdigg",
					"std" => 1,
					"type" => "checkbox"); 
					
$of_options[] = array( "name" => "Enable Delicious in Social Sharing Box",
					"desc" => "Check to enable Delicious in Social Sharing Box",
					"id" => "check_sharingboxdelicious",
					"std" => 1,
					"type" => "checkbox");
					
$of_options[] = array( "name" => "Enable Google in Social Sharing Box",
					"desc" => "Check to enable Google in Social Sharing Box",
					"id" => "check_sharingboxgoogle",
					"std" => 1,
					"type" => "checkbox"); 

$of_options[] = array( "name" => "Enable E-Mail in Social Sharing Box",
					"desc" => "Check to enable Google in E-Mail Sharing Box",
					"id" => "check_sharingboxemail",
					"std" => 1,
					"type" => "checkbox"); 

					
/* Portfolio
-------------------------------------------------------------------------------------------------------------------*/

$of_options[] = array( "name" => "Portfolio",
					"type" => "heading");
					
$of_options[] = array( "name" => "Portfolio Slug",
					"desc" => "Enter the URL Slug for your Portfolio (Default: portfolio-item) <br /><strong>Go save your permalinks after changing this.</strong>",
					"id" => "text_portfolioslug",
					"std" => "portfolio-item",
					"type" => "text"); 
					
$of_options[] = array( "name" => "Items on Portfolio Overview",
					"desc" => "Enter how many items you want to show on Portfolio Overview before Pagination shows up (Default: 16)",
					"id" => "text_portfolioitems",
					"std" => "16",
					"type" => "text"); 

$of_options[] = array( "name" => "Portfolio Page",
					"desc" => 'Select the page with all portfolio items. It will be used in the portfolio items navigation for "All" link',
					"id" 		=> "all_portfolio",
					"std" 		=> "select page",
					"type" 		=> "select",
					"options" 	=> $of_pages
				);

$of_options[] = array( "name" => "Portfolio Item Layout",
					"desc" => '',
					"id" 		=> "portfolio_layout",
					"std" 		=> "select layout",
					"type" 		=> "select",
					"options" 	=> array(
										'portfolio_full' => 'Full Width',
										'portfolio_minimal' => 'Minimal'
									)
				);

$of_options[] = array( "name" => "Related Items",
					"desc" => "Check to show related item on project page.",
					"id" => "related_items",
					"std" => 1,
					"type" => "checkbox");

$of_options[] = array( "name" => "Related Items Columns",
					"desc" => '',
					"id" 		=> "related_columns",
					"std" 		=> "span3",
					"type" 		=> "select",
					"options" 	=> array(
						'span3' => '4 columns',
						'span4' => '3 columns',
						'span6' => '2 columns'
					)
				);

$of_options[] = array( "name" => "Related Items Layout",
					"desc" => '',
					"id" 		=> "related_view",
					"std" 		=> "overlay",
					"type" 		=> "select",
					"options" 	=> array(
						'overlay' => 'overlay',
						'overlay_desc' => 'overlay with description',
						'overlay_plus_desc' => 'overlay + description'
					)
				);




/* Social Profiles
-------------------------------------------------------------------------------------------------------------------*/

$of_options[] = array( "name" => "Social Media",
					"type" => "heading");
					
$of_options[] = array( "name" => "Social Media Profiles",
					"desc" => "",
					"id" => "introduction",
					"std" => "Enter your username / URL to show or leave blank to hide Social Media Icons",
					"icon" => true,
					"type" => "info");

$of_options[] = array( "name" => "Email",
					"desc" => "Enter your public Email",
					"id" => "social_email",
					"std" => "",
					"type" => "text"); 
					
$of_options[] = array( "name" => "Twitter URL",
					"desc" => "Enter URL to your Twitter Account",
					"id" => "social_twitter",
					"std" => "",
					"type" => "text"); 

$of_options[] = array( "name" => "Forrst URL",
					"desc" => "Enter URL to your Forrst Account",
					"id" => "social_forrst",
					"std" => "",
					"type" => "text"); 

$of_options[] = array( "name" => "Dribbble URL",
					"desc" => "Enter URL to your Dribbble Account",
					"id" => "social_dribbble",
					"std" => "",
					"type" => "text"); 
					
$of_options[] = array( "name" => "Flickr URL",
					"desc" => "Enter URL to your Flickr Account",
					"id" => "social_flickr",
					"std" => "",
					"type" => "text"); 

$of_options[] = array( "name" => "Facebook URL",
					"desc" => "Enter URL to your Facebook Account",
					"id" => "social_facebook",
					"std" => "",
					"type" => "text"); 
					
$of_options[] = array( "name" => "Skype URL",
					"desc" => "Enter URL to your Skype Account",
					"id" => "social_skype",
					"std" => "",
					"type" => "text"); 
					
$of_options[] = array( "name" => "Digg URL",
					"desc" => "Enter URL to your Digg Account",
					"id" => "social_digg",
					"std" => "",
					"type" => "text"); 

$of_options[] = array( "name" => "Google+ URL",
					"desc" => "Enter URL to your Google+ Account",
					"id" => "social_google",
					"std" => "",
					"type" => "text"); 
					
$of_options[] = array( "name" => "LinkedIn URL",
					"desc" => "Enter URL to your LinkedIn Account",
					"id" => "social_linkedin",
					"std" => "",
					"type" => "text"); 
					
$of_options[] = array( "name" => "Vimeo URL",
					"desc" => "Enter URL to your Vimeo Account",
					"id" => "social_vimeo",
					"std" => "",
					"type" => "text"); 
					
$of_options[] = array( "name" => "Yahoo URL",
					"desc" => "Enter URL to your Yahoo Account",
					"id" => "social_yahoo",
					"std" => "",
					"type" => "text"); 
					
$of_options[] = array( "name" => "Tumblr URL",
					"desc" => "Enter URL to your Tumblr Account",
					"id" => "social_tumblr",
					"std" => "",
					"type" => "text"); 
					
$of_options[] = array( "name" => "YouTube URL",
					"desc" => "Enter URL to your YouTube Account",
					"id" => "social_youtube",
					"std" => "",
					"type" => "text"); 
					
$of_options[] = array( "name" => "Picasa URL",
					"desc" => "Enter URL to your Picasa Account",
					"id" => "social_picasa",
					"std" => "",
					"type" => "text"); 
					
$of_options[] = array( "name" => "DeviantArt URL",
					"desc" => "Enter URL to your DeviantArt Account",
					"id" => "social_deviantart",
					"std" => "",
					"type" => "text"); 
					
$of_options[] = array( "name" => "Behance URL",
					"desc" => "Enter URL to your Behance Account",
					"id" => "social_behance",
					"std" => "",
					"type" => "text");
					
$of_options[] = array( "name" => "Pinterest URL",
					"desc" => "Enter URL to your Pinterest Account",
					"id" => "social_pinterest",
					"std" => "",
					"type" => "text");  
					
$of_options[] = array( "name" => "PayPal URL",
					"desc" => "Enter URL to your PayPal Account",
					"id" => "social_paypal",
					"std" => "",
					"type" => "text"); 
					
$of_options[] = array( "name" => "Delicious URL",
					"desc" => "Enter URL to your Delicious Account",
					"id" => "social_delicious",
					"std" => "",
					"type" => "text"); 

$of_options[] = array( "name" => "Reddit URL",
					"desc" => "Enter URL to your Reddit Account",
					"id" => "social_reddit",
					"std" => "",
					"type" => "text"); 

$of_options[] = array( "name" => "Search Page URL",
					"desc" => "Enter URL to your website search page",
					"id" => "social_search",
					"std" => "",
					"type" => "text"); 
					
$of_options[] = array( "name" => "RSS URL",
					"desc" => "Enter URL to your RSS Feed",
					"id" => "social_rss",
					"std" => "",
					"type" => "text"); 

// Backup Options
$of_options[] = array( 	"name" 		=> "Backup",
						"type" 		=> "heading"
				);
				
$of_options[] = array( 	"name" 		=> "Backup and Restore Options",
						"id" 		=> "of_backup",
						"std" 		=> "",
						"type" 		=> "backup",
						"desc" 		=> 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
				);
				
$of_options[] = array( 	"name" 		=> "Transfer Theme Options Data",
						"id" 		=> "of_transfer",
						"std" 		=> "",
						"type" 		=> "transfer",
						"desc" 		=> 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
				);


	}//End function: of_options()
}//End chack if function exists: of_options()
?>
