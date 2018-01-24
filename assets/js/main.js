let myactcomp = {
	props:[
		'activities'
	],
	template: `<tr v-for="item in activities"><td>{{ item.activity_id }}</td><tr>`
}

let topmenu = new Vue({
	el:"#menuhaut",
	data:{
		
	}
});

let verticalmenu = new Vue({
	el:"#menuvertical",
	data:{
		username: "Gilles Yao"
	}
});

let app = new Vue({
	el:"#app",
	data:{
		base_uri: window.location.origin,
		title:"Bienvenue "+verticalmenu.username,
		description:null,
		activities:[
			{
				activity_id:1,
				activity_code:'ACT01',
				activity_description:'dsecription 1'
			},
			{
				activity_id:2,
				activity_code:'ACT02',
				activity_description:'dsecription 2'
			}
		],
		textzone:''
	},
	components:{
		'my-act-comp': myactcomp
	},
	methods: {
		loadActivities: function(){
			$.ajax({
					url:this.base_uri+"/activities",
					method:"GET",
					content:"json"
				}).fail(function(e){
					console.log(e)
				}).done(function(data){
					let container_head = `<table class="table table-hover">
					<tbody>
					`;
			let container_foot = `</tbody></table>`;
			let elems="";
			let ens;
			let result = data.activities;

			

			for(var i=0; i<result.length;i++){
				elems += `
					<tr>
						<td>`+result[i].activity_id+`</td>
						<td>`+result[i].activity_code+`</td>
						<td>`+result[i].activity_description+`</td>
					</tr>
				`;
				
			}
			
			ens = container_head+elems+container_foot;
			$("#content").html(ens)
				})
		}
	}
})