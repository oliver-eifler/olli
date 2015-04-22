# Define the Configuration
_s = require 'underscore.string'
docpadConfig = {
     outPath:                            'web-html/pages'
     srcPath:                            'web-html/_assets/docpad'
     plugins:
        moment:
            formats: [
                {raw: 'date', format: 'MMMM D, YYYY', formatted: 'humanDate'}
                {raw: 'date', format: '', formatted: 'computerDate'}
            ]
        cleanurls:
            enabled:true
        htmlmin:
            removeComments: true
            removeCommentsFromCDATA: false
            removeCDATASectionsFromCDATA: false
            collapseWhitespace: true
            collapseBooleanAttributes: false
            removeAttributeQuotes: false
            removeRedundantAttributes: false
            useShortDoctype: false
            removeEmptyAttributes: false
            removeOptionalTags: false
            removeEmptyElements: false
            # Disabled on development environments.
            environments:
                development:
                    enabled: true
    templateData:
        site:
            title: "Olli's Blog"
            excerptLength: 300
        getPreparedTitle: -> if @document.title then "#{@document.title} | #{@site.title}" else @site.title
        getExcerpt: (post) ->
            excerpt = ""
            if (post or @document).description then excerpt = (post or @document).description + " "
            excerpt += (post or @document).contentRenderedWithoutLayouts
            moreTag = /<!--\s*more\s*-->/i.exec(excerpt)
            if moreTag
                excerpt = _s.trim _s.stripTags( excerpt[0..moreTag.index-1] )
            else
                excerpt = _s.prune _s.stripTags(excerpt), @site.excerptLength, '&hellip;'
            excerpt
	collections:
		pages: ->
			@getCollection('html').findAllLive({isPage:true},[date:-1]).on "add", (model) ->
				model.setMetaDefaults({layout:"default",htmlmin:true})
		articles: ->
			@getCollection('html').findAllLive({isArticle:true},[date:-1]).on "add", (model) ->
				model.setMetaDefaults({layout:"article",htmlmin:true})
}

# Export the Configuration
module.exports = docpadConfig