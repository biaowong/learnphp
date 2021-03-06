$(function() {

	var g_table = $('table.data');
	var init_data_url = 'data.php?action=init_data_list';
	$.get(init_data_url, function(data) {

		var row_items = $.parseJSON(data);
		for (var i=0, j=row_items.length; i<j; i++) {

			var data_dom = create_row(row_items[i]);
			g_table.append(data_dom);
		}
	});

	function create_row(data_item) {

		var row_obj = $("<tr></tr>");
		for (var k in data_item) {
			if ("id" != k) {
				var col_td = $("<td></td>");
				col_td.html(data_item[k]);
				row_obj.append(col_td);
			}
		}

		var delButton = $("<a class='optLink' href='javascript:;'>删除&nbsp;</a>");
		delButton.attr('dataid', data_item['id']);
		delButton.click(delHandler);
		var editButton = $("<a class='optLink' href='javascript:;'>编辑</a>");
		editButton.attr('dataid', data_item['id']);
		editButton.click(editHandler);

		var opt_td = $("<td></td>");
		opt_td.append(delButton);
		opt_td.append(editButton);
		row_obj.append(opt_td);

		return row_obj;
	}

	function delHandler() {

		var data_id = $(this).attr("dataid");
		var meButton = $(this);
		$.post("data.php?action=del_row",{dataid:data_id},function(res){
			if ("ok" == res) {
				$(meButton).parent().parent().remove();
			}
			else {
				alert('刪除失败...');
			}
		});
	}

	function editHandler() {

		var data_id = $(this).attr("dataid");
		var meButton = $(this);
		// 没事件
		var meRow = $(this).parent().parent();
		var editRow = $("<tr></tr>");

		for (var i=0; i<8; i++) {
			var editTd = $("<td><input type='text' class='txtField' /></td>");
			var v = meRow.find('td:eq('+i+')').html();
			editTd.find('input').val(v);
			editRow.append(editTd);
		}
		var opt_td = $("<td></td>");
		var saveBtn = $("<a class='optLink' href='javascript:;'>保存&nbsp;</a>");
		var cancleBtn = $("<a class='optLink' href='javascript:;'>取消</a>");

		saveBtn.click(function() {

			var currentRow = $(this).parent().parent();
			var input_fields = currentRow.find("input");
			var post_fields = {};
			for (var i=0, j=input_fields.length; i<j; i++) {
				post_fields['col_'+i] = input_fields[i].value;
			}
			post_fields['id'] = data_id;
			$.post("data.php?action=edit_row", post_fields, function(res) {

				if ("ok" == res) {
					var newUpdateRow = create_row(post_fields);
					currentRow.replaceWith(newUpdateRow);
				}
				else {
					alert("数据更新失败...");
				}
			});
		});

		cancleBtn.click(function() {

			var currentRow = $(this).parent().parent();
			meRow.find('a:eq(0)').click(delHandler);
			meRow.find('a:eq(1)').click(editHandler);
			currentRow.replaceWith(meRow);
		});

		opt_td.append(saveBtn);
		opt_td.append(cancleBtn);
		editRow.append(opt_td);
		meRow.replaceWith(editRow);
	}

	$("#addBtn").click(function() {

		var addRow = $("<tr></tr>");
		for (var i=0; i<8; i++) {
			var col_td = $("<td><input type='text' class='txtField'/></td>");
			addRow.append(col_td);
		}

		var col_opt = $("<td></td");
		var confirmBtn = $("<a class='optLink' href='javascript:;'>确认&nbsp;</a>");
		var cancleBtn = $("<a class='optLink' href='javascript:;'>取消</a>");

		confirmBtn.click(function() {
			var currentRow = $(this).parent().parent();
			var input_fields = currentRow.find("input");
			var post_fields = {};
			for (var i=0, j=input_fields.length; i<j; i++) {
				post_fields['col_'+i] = input_fields[i].value;
			}
			$.post("data.php?action=add_row", post_fields, function(res) {
				if (0 < res) {
					post_fields['id'] = res;
					var postAddRow = create_row(post_fields);
					currentRow.replaceWith(postAddRow);
				}
				else {
					alert("插入失败...");
				}
			});
		});

		cancleBtn.click(function() {
			$(this).parent().parent().remove();
		});

		col_opt.append(confirmBtn);
		col_opt.append(cancleBtn);
		addRow.append(col_opt);
		g_table.append(addRow);
	});
});
