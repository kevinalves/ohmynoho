(function (dojo) {
    dojo.declare("NextendElementYoutubeToken", NextendElement, {
        constructor: function (args) {
            dojo.mixin(this, args);
            this.hidden = dojo.byId(this.hidden);
            this.link = dojo.byId(this.link);
            this.callback = dojo.byId(this.callback);

            this.api_key = dojo.byId('jformparamsconfigapikey');
            this.api_secret = dojo.byId('jformparamsconfigapisecret');


            this.form = this.hidden.form.nextendform;
            this.url = this.form.url + (this.form.url.match(/\?/) ? '&' : '?') + 'nextendajax=1&mode=auth&folder=' + this.folder;

            this.callback.innerHTML = 'Calback url: ' + this.url;


            dojo.connect(this.link, 'click', this, 'startAuth');
        },

        startAuth: function () {
            window.setToken = dojo.hitch(this, 'setToken');
            this.window = window.open(this.url + '&api_key=' + this.api_key.value + '&api_secret=' + this.api_secret.value +
                '&redirect_uri=' + encodeURIComponent(this.url),
                'youtubeApi',
                'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=1060,height=950');
        },

        setToken: function (value) {
            this.hidden.value = value;
            if (this.window) this.window.close();
        }
    });
})(ndojo);