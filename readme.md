## 多用户(users) ##

### 注册 ###

### 登录、登出 ###

### 找回密码 ###

### 微信登录 ###

## 工作报告 ##

> - `工作报告`数据表(reports)
> 
>  0. ID(id)
>  0. 分类(classification_id)
>  0. 地点(address)
>  0. 描述(description)
>  0. 备注(remark)
>  0. 添加人(user_id)
>  0. 创建时间(created_at)
>  0. 修改时间(updated_at)
>  
> ---
> - `报告分类`数据表(classifications)
> 
>  0. ID(id)
>  0. 分类名(name)
>  0. 创建时间(created_at)
>  0. 修改时间(updated_at)

### 条件查询（index） ###

按时间、添加人员、事件分类等信息进行查询

### 导出（export） ###

按时间、添加人员、事件分类等信息导出Excel表格

### 添加一条工作报告（create、store） ###

### 查看一条工作报告详情（show） ###

查看工作报告

### 编辑（更新）一条工作报告（edit、update） ###

### 删除一条工作报告（destory） ###

## 物品管理 ##

> - 数据表(assets)
> 
>  0. 物品ID（id）
>  0. 物品名（name）
>  0. 描述（description）
>  0. 物品状态：正常|借出|已报废（status）
>  0. 创建时间(created_at)
>  0. 修改时间(updated_at)
>  0. 删除时间(deleted_at)
>  
> - 数据表(details)
> 
>  0. 历史记录ID（id）
>  0. 物品ID（asset_id）
>  0. 借出人（name）
>  0. 电话（cellphone）
>  0. 备注（remark）
>  0. 预计归还时间（return_time）
>  0. 创建时间(created_at)
>  0. 修改时间(updated_at)

### 查询概况（index） ###

### 导出（export） ###

### 添加物品（create、store） ###

### 查看物品详情(show) ###

### 修改（edit、store） ###

### 删除（destory） ###

### 登记借出信息 ###

### 归还 ###
