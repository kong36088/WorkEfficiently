function taskInit() {
    expandTaskOptions();
    inputTaskSubmit();
    inputTaskDelete();
}
//点击增加分类
$("#add-category-btn").on("click", function () {
    addCategoryModal.modal("show");
});

//提交添加
addCategoryModal.find("button[name=submit]").on("click", function () {
    var category_name = addCategoryModal.find("input[name=category_name]").val();
    if (category_name == null || category_name == '') {
        alert('请填写分类名称');
        return false;
    }
    data = {
        category_name: category_name
    };
    http.post("{{base_url('/todo/addCategory')}}", data)
        .success(function (data, status) {
            data = parseJson(data)[0];
            if (data.code == 1) {
                window.location.reload();
            } else {
                alert(data.message);
            }
        });
});

//点击增加任务
$("a[name=add-task]").on("click", function () {
    $(".task-list").append($("#taskInput").html());
    taskInit();
});

//点击打开任务详情
function expandTaskOptions() {
    $("button[name=table-btn-expand]").unbind().on("click", function () {
        var taskId = $(this).data('taskid');
        console.log(taskId);
        data = {
            task_id:taskId
        };
        http.post(getTaskOptionsUrl, data)
            .success(function (data, status) {
                data = parseJson(data)[0];
                if (data.code == 1) {
                    var html;
                    for(x in data.data){
                        var d = data.data[x];
                        html += juicer($("#taskTr").html(),{
                            id:d.id,
                            title:d.title
                        });
                    }
                    $("#task-option-body").empty().append(html);
                    init();
                } else {
                    alert(data.message);
                }
            });
        init();
        $("#taskOptionModal").attr('data-taskid',taskId);
        taskOptionModel.modal("show");
    });
}

//提交增加新任务表单
function inputTaskSubmit() {
    $("button[name=table-btn-input-finish]").unbind().on("click", function () {
        var th = $(this);
        var title = $(this).parent().parent().find("input[name=title]").val();
        var category_id = $(this).parent().parent().parent().parent().data('category-id');
        if (!title || !category_id) {
            alert('请填写任务内容');
            return false;
        }
        data = {
            category_id: category_id,
            title: title
        };
        http.post(addTaskUrl, data)
            .success(function (data, status) {
                data = parseJson(data)[0];
                if (data.code == 1) {
                    var html = juicer($("#taskTr").html(),{
                        id:data.data.id,
                        title:data.data.title
                    });
                    th.parent().parent().parent().append(html);

                    th.parent().parent().remove();
                    init();
                } else {
                    alert(data.message);
                }
            });
    });
}

//点击删除输入框
function inputTaskDelete(){
    $("button[name=table-btn-input-delete]").unbind().on("click", function () {
        $(this).parent().parent().remove();
    });
}

function taskFinish(){
    $("#table-btn-finish").unbind().on("click",function(){
        var taskId = $(this).data('taskid');
        
    })
}
