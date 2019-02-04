<template>
    <nav class="panel">
        <p class="panel-heading">
            Phone book&nbsp;<button class="button is-link is-outlined" @click="addModal">
                Add new
            </button>
            <span class="is-pulled-right" v-if="loading"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
            <span class="sr-only">Loading...</span></span>

        </p>
        <div class="panel-block">
            <p class="control has-icons-left">
                <input class="input" type="text" placeholder="search" v-model="searchQuery">
                <span class="icon is-small is-left">
        <i class="fa fa-search" aria-hidden="true"></i>
      </span>
            </p>
        </div>
        <a class="panel-block is-active" v-for="item,key in temp">
            <span class="column is-9">{{item.name}}</span>
            <span class="has-text-danger column is-1" @click="del(key,item.id)"><i class="fa fa-trash" aria-hidden="true"></i></span>
            <span class="has-text-info column is-1" @click="update(key)"><i class="fa fa-edit" aria-hidden="true"></i></span>
            <span class="has-text-default column is-1" @click="show(key)"><i class="fa fa-eye" aria-hidden="true"></i></span>
        </a>
        
        <Add :openmodal="addActive" @close="closeModal"></Add>
        <Show :openshow="addShow" @close="closeModal"></Show>
        <Edit :openedit="openEdit" @close="closeModal"></Edit>
    </nav>
</template>
<script type="text/javascript">
    let Add=require('./Add.vue').default;
    let Show=require('./addShow.vue').default;
    let Edit=require('./Editdetail.vue').default;
    export default{
        components:{Add,Show,Edit},
        data(){
            return{
                addActive:'',
                addShow:'',
                openEdit:'',
                lists:{},
                errors:{},
                loading:false,
                searchQuery:'',
                temp:''
            }

        },
        mounted(){
            axios.post('/getdata').then((response)=>this.lists=this.temp=response.data).catch((error)=>this.errors=error.response.data.errors);
        },
        watch:{
            searchQuery(){
               if(this.searchQuery.length > 0){
                    this.temp=this.lists.filter((item)=>{
                        return Object.keys(item).some((key)=>{
                            let string=String(item[key]);
                            return string.toLowerCase().indexOf(this.searchQuery.toLowerCase())>-1
                        })
                    });
               }else{
                this.temp=this.lists;
               }
            }
        },
        methods:{
            addModal(){
                this.addActive="is-active";
            },
            show(key){
                this.$children[1].list=this.temp[key];
                this.addShow="is-active";
            },
            update(key){
                this.$children[2].list=this.temp[key];
                this.openEdit="is-active";
            },
            closeModal(){
                this.addActive=this.addShow=this.openEdit='';
            },
            del(key,id){
                if(confirm('Are you sure?')){
                this.loading=!this.loading;
                 axios.delete(`/phonebook/${id}`).then((response)=>{this.lists.splice(key,1);
                    this.loading=!this.loading;}).catch((error)=>this.errors=error.response.data.errors);
                }
            }
        }
    }
</script>