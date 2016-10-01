function parseJson(json){
    return eval('['+json+']');
}

String.prototype.trim = function (char, type) {
    if (char) {
        if (type == 'left') {
            return this.replace(new RegExp('^\\'+char+'+', 'g'), '');
        } else if (type == 'right') {
            return this.replace(new RegExp('\\'+char+'+$', 'g'), '');
        }
        return this.replace(new RegExp('^\\'+char+'+|\\'+char+'+$', 'g'), '');
    }
    return this.replace(/^\s+|\s+$/g, '');
};

juicer.set({
    'tag::operationOpen': '{$',
    'tag::operationClose': '}',
    'tag::interpolateOpen': '${',
    'tag::interpolateClose': '}',
    'tag::noneencodeOpen': '$${',
    'tag::noneencodeClose': '}',
    'tag::commentOpen': '{#',
    'tag::commentClose': '}'
});