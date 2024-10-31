// This function runs on page load in the editor area, adding our plugin shortcode button to the visual editor
(function() {  
    tinymce.create('tinymce.plugins.sitelink', {  
        init : function(ed, url) {  
            ed.addButton('sitelink', {  
                title : 'Insert SiteLink Embed Code',  
                image : url+'/sitelink.png',  
                onclick : function() {  
                     ed.selection.setContent('[sitelink class=""]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('sitelink', tinymce.plugins.sitelink);  
})();