
/*
enyo.ready(function () {
	new MyApp.Application({name: "app"});
});
*/

//step 1 - mvc
/*
enyo.ready(function() {

	enyo.kind({
		name: "Sample.Object",
		kind: "enyo.Object",
		property1: "initial value",
		_property1_changed: enyo.observer(function(property, previous, value) {
			this.log("my value changed to: " + value + " from " + previous);
		}, "property1")
	});
	
	obj = new Sample.Object();

});
*/
//obj.set("property1", "123")

//step 2 - mvc
/*
enyo.ready(function() {

	enyo.kind({
		name: "Sample.Object",
		kind: "enyo.Object",
		property1: "value1"
	});
	
	obj = new Sample.Object();
	obj2 = new enyo.Object();
	
	bind = new enyo.Binding({
		source: obj,
		target: obj2,
		from: ".property1",
		to: ".myprop"
	});
});
*/
//obj.set("property1", "123")
//obj2.get("myprop")


//step 3 - mvc
/*
enyo.ready(function() {

	enyo.kind({
		name: "Sample.Object",
		kind: "enyo.Object",
		property1: "value1"
	});
	
	obj = new Sample.Object();
	obj2 = new enyo.Object();
	
	bind = new enyo.Binding({
		source: obj,
		target: obj2,
		from: ".property1",
		to: ".myprop",
		oneWay: true
	});
});
*/

//step 4 - mvc
/*
enyo.ready(function() {

	enyo.kind({
		name: "Sample.View",
		kind: "enyo.View",
		
		bindings: [
			{
				from: ".$.view1.content",
				to: ".$.view2.content"
			}
		],
		
		components: [
			{name: "view1", content: "h1"},
			{name: "view2"}
		]
	});
	
	obj = new Sample.View().renderInto(document.body);
});
*/
//obj.$.view1.setContent("Hello World!")

//step 5 - mvc
/*
enyo.ready(function() {

	enyo.kind({
		name: "Sample.View",
		kind: "enyo.View",
		content: "h1",
		firstName: "first",
		lastName: "last",
		
		property1: enyo.computed(function() {
			return this.firstName + this.lastName;
		}, "firstName", "lastName", {cached: true})
	});
	
	enyo.kind({
		name: "Sample.Application",
		kind: "enyo.Application",
		view: "Sample.View"
	});
	
	app = new Sample.Application({name: "app"});
});
*/
//app.view.get("property1")

//step 6 - mvc
/*
enyo.ready(function() {

	enyo.kind({
		name: "Sample.View",
		kind: "enyo.View",
		controller: ".app.controllers.modelController",
		bindings: [
			{from: ".controller.first", to: ".$.first.content"},
			{from: ".controller.last", to: ".$.last.content"},
			{from: ".controller.fullName", to: ".$.full.content"},
			{from: ".controller.age", to: ".$.age.content"}
		],
		components: [
			{
				layoutKind: "enyo.FittableColumnsLayout",
				//kind: "FittableColumns",
				components: [
					{name: "first"},
					{name: "last"},
					{name: "full"},
					{name: "age"}
				]
			}
		]
	});
	
	enyo.kind({
		name: "Sample.Application",
		kind: "enyo.Application",
		controllers: [
			{
				name: "modelController",
				kind: "enyo.ModelController",
				fullName: enyo.computed(function() {
					return this.get("first") + " " + this.get("last");
				}, "first", "last")
			}
		],
		view: "Sample.View"
	});
	
	enyo.kind({
		name: "Sample.ContactModel",
		kind: "enyo.Model",
		attributes: {
			first: "",
			last: "",
			age: 0
		}
	});
	
	app = new Sample.Application({name: "app"});
});
*/
//model = new Sample.ContactModel({first: "Cole", last: "Davis", age: 30})
//app.controllers.modelController.set("model", model)



//step 7 - mvc
/*
enyo.ready(function() {

	enyo.kind({
		name: "Sample.View",
		kind: "enyo.DataList",
		controller: ".app.controllers.contacts",
		components: [
			{bindFrom: ".first"},
			{bindFrom: ".last"},
			{bindFrom: ".age"},
		]
	});
	
	enyo.kind({
		name: "Sample.Application",
		kind: "enyo.Application",
		controllers: [
			{
				name: "contacts",
				kind: "enyo.Collection"
			}
		],
		view: "Sample.View"
	});
	
	app = new Sample.Application({name: "app"});
	
	app.controllers.contacts.add([
		{
			first: "First1",
			last: "Last1",
			age: 1
		},
		{
			first: "First2",
			last: "Last2",
			age: 2
		},
		{
			first: "First3",
			last: "Last3",
			age: 3
		}
	]);
});
*/

//step 8 - mvc
enyo.ready(function() {

	enyo.kind({
		name: "Sample.Object",
		kind: "enyo.Object",
		color: "Blue",
		_color_changed: enyo.observer(function(property, previous, value) {
			if (value == "Green") {
				alert("You made it!");
			}
		}, "color")
	});
	
	obj = new Sample.Object();
});
//obj.set("color", "Green")

