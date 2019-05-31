<template>
 	<div class="pokedox-nav-container">
		<v-navigation-drawer
	  	v-model="drawer"
	  	absolute
	  	app
	  	class="pokedox-vertical-side-menu">
			<!-- <sidebar-left-other-device v-if="isSidebarLeft"></sidebar-left-other-device> -->
		</v-navigation-drawer>
		
		<v-toolbar color="indigo" dark flat height="50" class="pokedox-horizental-nav">
			<v-toolbar-side-icon @click.stop="drawer = !drawer" class="pokedox-verticalside-menu-btn" flat></v-toolbar-side-icon>
			<v-toolbar-title>Pokedox</v-toolbar-title>
    		<v-spacer></v-spacer>
			<v-btn flat id="myaccount" :class="isRoute('pokemon.index')" @click="redirect('pokemon.index');">Pokemons</v-btn>
			<v-btn flat id="websites" :class="isRoute('collection.index')" @click="redirect('collection.index');">Ma collection</v-btn>
		</v-toolbar>
	</div>
</template>

<script>
	export default {
		data:()=>({
			drawer:''
		})
	}
</script>

<style lang="scss">
	.pokedox-nav-container{
		.pokedox-vertical-side-menu{
			margin-top:105px !important;
			overflow:visible;
			
			.v-list__group__items--no-action .v-list__tile{
				padding-left:30px !important;
				color:#616161;
			}
			.v-list__group__header{
				.v-list__group__header__append-icon{
					i{
						position:relative;
						
						&:after{
							content:"remove";
							font-family: 'Material Icons';
							color: rgba(0,0,0,.54);
							font-size: 24px;
							transform: rotate(-90deg);
							position: absolute;
							/* top: -25px; */
							top: -1px;
							bottom: 0;
							/* left: 13px;*/
							/* right: -3px;*/
							right: 0;
							margin: auto;
						}
					}
				}
			}
			.v-list__group__header--active{
				.v-list__group__header{
					background-color:#fafafa;
				}
				
				.v-list__group__header__append-icon{
					i{
						position:initial;
						
						&:after{
							content:"";
						}
					}
				}
			}
			.v-list__group--active .v-list__group__header{
				background-color:#fafafa;
				margin: 0 10px;
				border-radius: 5px;
			}
			.v-list__group__items{
				background-color:#fff;
			}
			.v-list__group{
				&:before, &:after{
					background: rgba(0,0,0,0);
				}
			}
		}
		
		.v-overlay{
			top:105px !important;
		}
		
		.pokedox-horizental-nav{
			background-color:#1e1e1e !important;
			-webkit-box-shadow: inset 0px 34px 0px -8px rgba(255,255,255,0.4) !important;
			-moz-box-shadow: inset 0px 34px 0px -8px rgba(255,255,255,0.4) !important;
			box-shadow: inset 0px 34px 0px -8px rgba(255,255,255,0.4)  !important;
			
			.v-toolbar__content{
				padding-left:0 !important;
				
				button{
					&.pokedox-verticalside-menu-btn{
						height:50px;
						background-color:#7c9215 !important;
						-webkit-box-shadow: inset 0px 34px 0px -8px rgba(255,255,255,0.4) !important;
						-moz-box-shadow: inset 0px 34px 0px -8px rgba(255,255,255,0.4) !important;
						box-shadow: inset 0px 34px 0px -8px rgba(255,255,255,0.4)  !important;
						margin-left: 0px;
						width: 50px;
						
						&.v-btn--icon{
							-webkit-border-radius: 0px;
							-moz-border-radius: 0px;
							border-radius: 0px;
						}
					}
					
				}
			}
			
			.v-btn{
				width:16%;
				margin:0 !important;
				padding:0 !important;
				
				&.isActive{
					height:50px;
					background-color:#7c9215 !important;
					-webkit-box-shadow: inset 0px 34px 0px -8px rgba(255,255,255,0.4) !important;
					-moz-box-shadow: inset 0px 34px 0px -8px rgba(255,255,255,0.4) !important;
					box-shadow: inset 0px 34px 0px -8px rgba(255,255,255,0.4)  !important;
				}
			}
		}
	}
</style>