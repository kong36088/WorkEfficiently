/**
 * Created by PhpStorm.
 * Author: William
 * Date: 2016/9/21
 * Time: 15:29
 */

http = {
    get: function (url, data) {
        $(".loading").css('display', 'block');
        return request.get(url, data)
            .complete(function () {
                $(".loading").css('display', 'none');
            })
            .error(function (xmlobject, error) {
                $(".loading").css('display', 'none');
                alert('操作失败，请重试');
            });
    },
    post: function (url, data) {
        $(".loading").css('display', 'block');
        return request.post(url, data)
            .complete(function () {
                $(".loading").css('display', 'none');
            })
            .error(function (xmlobject, error) {
                $(".loading").css('display', 'none');
                alert('操作失败，请重试');
            });
    },
    put: function (url, data) {
        $(".loading").css('display', 'block');
        return request.put(url, data)
            .complete(function () {
                $(".loading").css('display', 'none');
            })
            .error(function (xmlobject, error) {
                $(".loading").css('display', 'none');
                alert('操作失败，请重试');
            });
    },
    delete: function (url, data) {
        $(".loading").css('display', 'block');
        return request.delete(url, data)
            .complete(function () {
                $(".loading").css('display', 'none');
            })
            .error(function (xmlobject, error) {
                $(".loading").css('display', 'none');
                alert('操作失败，请重试');
            });
    }
};
