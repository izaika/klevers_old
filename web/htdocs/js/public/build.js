({
    baseUrl: ".",
    name: "main",
    mainConfigFile: 'main.js',
    out: "main-built.js",
    
    include: [
        'modernizr',
        'jquery',
        'googleMaps',
        'mousewheel',
        'swiper',
        'isotope',
        'imagesLoaded',
		'cs!pages/about.coffee',
        'cs!pages/blog.coffee',
		'cs!pages/contact.coffee',
		'cs!pages/home.coffee',
		'cs!pages/index.coffee',
		'cs!pages/project_article.coffee',
        'cs!pages/projects.coffee',
        'cs!pages/search.coffee',
		'cs!pages/exception404.coffee'
    ]
})
