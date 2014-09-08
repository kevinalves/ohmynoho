(function ($, scope, undefined) {
    scope.ssItemParserflipper = scope.ssItemParser.extend({
        parse: function (name, data) {
            var o = this._super(name, data);
            if (name === 'link') {
                var _d = data.split('|*|');
                o.url = _d[0];
                o.target = _d[1];
                o.cursor = _d[2];
                delete o.size;
            }
            return o;
        },
        render: function(node, data){
            if(data['url'] == '#'){
                var a = node.children('a');
                node.append(a.children());
                a.remove();
            }
            return node;
        }
    });
})(njQuery, window);
