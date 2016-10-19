$(document).ready(function() {
    var init = new Init();
    init.onloadInit();

    var template = $('.container.main').attr('data-page');
    switch (template) {
        case 'main':
            var templateCtrl = new Main();
            break;
        case 'statistic':
            var templateCtrl = new List();
            break;
        default:
            return;
    }

    templateCtrl.init();

    $('.logout').on('click', function() {
        new Session().logout();
    });
});
