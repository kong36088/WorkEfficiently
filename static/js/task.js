function taskInit() {
    expandTaskOptions();
    inputTaskSubmit();
    inputTaskDelete();
    taskFinish();
    deleteTask();
    submitChangeCategoryName();
    deleteCategory();
    getFinishTask();
    undoTask();
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
    http.post(addCategoryUrl, data)
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
    $(this).parent().parent().parent().find(".task-list").append($("#taskInput").html());
    taskInit();
});

//点击打开任务详情
function expandTaskOptions() {
    $("button[name=table-btn-expand]").unbind().on("click", function () {
        var taskId = $(this).data('taskid');
        var taskTitle = $(this).parent().parent().find("[name=task-title]").text();
        data = {
            task_id: taskId
        };
        http.post(getTaskOptionsUrl, data)
            .success(function (data, status) {
                data = parseJson(data)[0];
                if (data.code == 1) {
                    var html;
                    for (x in data.data) {
                        var d = data.data[x];
                        html += juicer($("#taskOptionTr").html(), {
                            id: d.id,
                            title: d.title,
                            status:d.status
                        });
                    }
                    $("#task-option-body").empty().append(html);
                    init();
                } else {
                    alert(data.message);
                }
            });
        init();
        $("#taskOptionModal").attr('data-taskid', taskId);
        $("#taskOptionModal").find(".modal-title").text(taskTitle);
        taskFinishModal.modal('hide');
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
                    var html = juicer($("#taskTr").html(), {
                        id: data.data.id,
                        title: data.data.title
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
function inputTaskDelete() {
    $("button[name=table-btn-input-delete]").unbind().on("click", function () {
        $(this).parent().parent().remove();
    });
}

//完成任务
function taskFinish() {
    $("button[name=table-btn-finish]").unbind().on("click", function () {
        var taskId = $(this).data('taskid');
        var data = {
            task_id: taskId,
            status: 2
        };
        var th = $(this);
        http.post(changeTaskStatusUrl, data)
            .success(function (data, status) {
                data = parseJson(data)[0];
                if (data.code == 1) {
                    th.parent().parent().remove();
                } else {
                    alert(data.message);
                }
            });
    })
}
//删除任务
function deleteTask() {
    $("button[name=table-btn-delete]").unbind().on('click', function () {
        if (confirm('确定要删除任务吗？')) {
            var taskId = $(this).data('taskid');
            var data = {
                task_id: taskId,
            };
            var th = $(this);
            http.post(deleteTaskUrl, data)
                .success(function (data, status) {
                    data = parseJson(data)[0];
                    if (data.code == 1) {
                        th.parent().parent().remove();
                    } else {
                        alert(data.message);
                    }
                });
        }
    })
}

//点击修改分类名称
$("a[name=change-category-name]").unbind().on("click", function () {
    var category_id = $(this).data('id');
    var categoryName = $(this).parents(".panel").find(".category-name").text();
    changeCategoryNameModal.find("input[name=category_name]").val(categoryName);
    changeCategoryNameModal.find("input[name=category_id]").val(category_id);
    changeCategoryNameModal.modal('show');
});

//提交修改分类名称
function submitChangeCategoryName() {
    changeCategoryNameModal.find("button[name=submit]").unbind().on("click", function () {
        var categoryName = changeCategoryNameModal.find("input[name=category_name]").val();
        var categoryId = changeCategoryNameModal.find("input[name=category_id]").val();
        var data = {
            category_id: categoryId,
            category_name: categoryName
        };
        http.post(changeCategoryNameUrl, data)
            .success(function (data, status) {
                data = parseJson(data)[0];
                if (data.code == 1) {
                    window.location.reload();
                } else {
                    alert(data.message);
                }
            });
    })
}

//删除分类
function deleteCategory(){
    $("a[name=delete-category]").unbind().on('click', function () {
        if (confirm('确定要删除分类吗？（将无法恢复）')) {
            var categoryId = $(this).data('id');
            var data = {
                category_id: categoryId,
            };
            var th = $(this);
            http.post(deleteCategoryUrl, data)
                .success(function (data, status) {
                    data = parseJson(data)[0];
                    if (data.code == 1) {
                        window.location.reload();
                    } else {
                        alert(data.message);
                    }
                });
        }
    })
}
//获取已完成任务
function getFinishTask(){
    $("button[name=get-finish-task-btn]").unbind().on("click",function(){
        var categoryId = $(this).data('categoryid');
        data = {
            category_id: categoryId
        };
        http.post(getFinishTaskUrl, data)
            .success(function (data, status) {
                data = parseJson(data)[0];
                if (data.code == 1) {
                    var html;
                    for (x in data.data) {
                        var d = data.data[x];
                        html += juicer($("#finishTaskTr").html(), {
                            id: d.id,
                            title: d.title,
                            status:d.status
                        });
                    }
                    $("#task-finished-body").empty().append(html);
                    init();
                } else {
                    alert(data.message);
                }
            });
        init();
        taskFinishModal.modal("show");
    })
}
//重新开启任务
function undoTask(){
    $("button[name=table-btn-undo]").unbind().on("click",function(){
        var taskId = $(this).data('taskid');
        var data = {
            task_id:taskId,
            status:1
        };
        var th = $(this);
        http.post(changeTaskStatusUrl,data)
            .success(function(data,status){
                data = parseJson(data)[0];
                if(data.code==1){
                    window.location.reload();
                }else{
                    alert(data.message);
                }
            });
    })
}