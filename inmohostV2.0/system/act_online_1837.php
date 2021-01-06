<?  include "../parametros.php";
				
						 extract($_GET);
					     include "../include/funciones/funciones.php";
						 
						 
						 $propiedad=PropiedadesPeer::retrieveByPK(1,1837);if(!$propiedad){
												$propiedad=new Propiedades();
											}
									$propiedad->setPrpId(1);
								    $propiedad->setPrpDom("dddddddd");
								    $propiedad->setPrpBar("");
								    $propiedad->setLocId(1);
								    $propiedad->setProId(21);
								    $propiedad->setPaiId(1);
								    $propiedad->setOriId(3);
								    $propiedad->setConId(2);
								    $propiedad->setFotos(0);
								    $propiedad->setPrpDesc(" ");
								    $propiedad->setUsrId(1837);
								    $propiedad->setTipId(7);
								    $propiedad->setPrpMod("2010-09-17");
								    $propiedad->setPrpAlta("2010-09-17");
								    $propiedad->setPrpNota(" ");
								    $propiedad->setPrpPre(0);
								    $propiedad->setPrpMostrar(4);
								    $propiedad->setPrpPreDol(0);
								    $propiedad->setPrpCartel(0);
								    $propiedad->setPrpReferente(0);
								    $propiedad->setPublica(1);
								    $propiedad->setPrpServicios(" ");
								    $propiedad->setBarPrivId(0);
								    $propiedad->setPrpVip(0);
								    $propiedad->setMosPor1(1);
								    $propiedad->setMosPor2(1);
								    $propiedad->setMosPor3(1);
								    $propiedad->setMosPor4(0);
								    $propiedad->setPrpAnonimo(0);
								    $propiedad->setPrpLat("");
								    $propiedad->setPrpLng("");
								    
								    
								    
									
											$c=new Criteria();
											$c->add(SerXPrpIhostPeer::USR_ID , 1837);
											$c->add(SerXPrpIhostPeer::PRP_ID , 1);
											SerXPrpIhostPeer::doDelete($c);
											
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(2,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(2);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(3,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(3);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(4,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(4);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(7,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(7);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(8,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(8);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(9,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(9);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(10,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(10);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(11,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(11);
									 			$s->setValor("indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(12,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(12);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(13,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(13);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(14,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(14);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(15,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(15);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(16,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(16);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(17,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(17);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(18,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(18);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(19,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(19);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(20,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(20);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(21,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(21);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(22,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(22);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(23,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(23);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
											$c=new Criteria();
											$c->add(FotosPeer::USR_ID , 1837);
											$c->add(FotosPeer::PRP_ID , 1);
											FotosPeer::doDelete($c);
											$propiedad->save();$propiedad=PropiedadesPeer::retrieveByPK(2,1837);if(!$propiedad){
												$propiedad=new Propiedades();
											}
									$propiedad->setPrpId(2);
								    $propiedad->setPrpDom("jejeje");
								    $propiedad->setPrpBar("");
								    $propiedad->setLocId(1);
								    $propiedad->setProId(21);
								    $propiedad->setPaiId(1);
								    $propiedad->setOriId(0);
								    $propiedad->setConId(3);
								    $propiedad->setFotos(0);
								    $propiedad->setPrpDesc("   ");
								    $propiedad->setUsrId(1837);
								    $propiedad->setTipId(7);
								    $propiedad->setPrpMod("2010-09-17");
								    $propiedad->setPrpAlta("2010-09-17");
								    $propiedad->setPrpNota("   ");
								    $propiedad->setPrpPre(3434);
								    $propiedad->setPrpMostrar(4);
								    $propiedad->setPrpPreDol(434);
								    $propiedad->setPrpCartel(0);
								    $propiedad->setPrpReferente(0);
								    $propiedad->setPublica(1);
								    $propiedad->setPrpServicios("   ");
								    $propiedad->setBarPrivId(0);
								    $propiedad->setPrpVip(0);
								    $propiedad->setMosPor1(1);
								    $propiedad->setMosPor2(1);
								    $propiedad->setMosPor3(1);
								    $propiedad->setMosPor4(0);
								    $propiedad->setPrpAnonimo(0);
								    $propiedad->setPrpLat("");
								    $propiedad->setPrpLng("");
								    
								    
								    
									
											$c=new Criteria();
											$c->add(SerXPrpIhostPeer::USR_ID , 1837);
											$c->add(SerXPrpIhostPeer::PRP_ID , 2);
											SerXPrpIhostPeer::doDelete($c);
											
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(2,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(2);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(3,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(3);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(4,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(4);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(7,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(7);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(8,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(8);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(9,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(9);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(10,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(10);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(11,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(11);
									 			$s->setValor("indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(12,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(12);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(13,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(13);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(14,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(14);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(15,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(15);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(16,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(16);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(17,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(17);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(18,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(18);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(19,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(19);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(20,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(20);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(21,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(21);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(22,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(22);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(23,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(23);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
											$c=new Criteria();
											$c->add(FotosPeer::USR_ID , 1837);
											$c->add(FotosPeer::PRP_ID , 2);
											FotosPeer::doDelete($c);
											$propiedad->save();$propiedad=PropiedadesPeer::retrieveByPK(2,1837);if(!$propiedad){
												$propiedad=new Propiedades();
											}
									$propiedad->setPrpId(2);
								    $propiedad->setPrpDom("jejeje");
								    $propiedad->setPrpBar("");
								    $propiedad->setLocId(1);
								    $propiedad->setProId(21);
								    $propiedad->setPaiId(1);
								    $propiedad->setOriId(0);
								    $propiedad->setConId(3);
								    $propiedad->setFotos(0);
								    $propiedad->setPrpDesc("   ");
								    $propiedad->setUsrId(1837);
								    $propiedad->setTipId(7);
								    $propiedad->setPrpMod("2010-09-17");
								    $propiedad->setPrpAlta("2010-09-17");
								    $propiedad->setPrpNota("   ");
								    $propiedad->setPrpPre(3434);
								    $propiedad->setPrpMostrar(4);
								    $propiedad->setPrpPreDol(434);
								    $propiedad->setPrpCartel(0);
								    $propiedad->setPrpReferente(0);
								    $propiedad->setPublica(1);
								    $propiedad->setPrpServicios("   ");
								    $propiedad->setBarPrivId(0);
								    $propiedad->setPrpVip(0);
								    $propiedad->setMosPor1(1);
								    $propiedad->setMosPor2(1);
								    $propiedad->setMosPor3(1);
								    $propiedad->setMosPor4(0);
								    $propiedad->setPrpAnonimo(0);
								    $propiedad->setPrpLat("");
								    $propiedad->setPrpLng("");
								    
								    
								    
									
											$c=new Criteria();
											$c->add(SerXPrpIhostPeer::USR_ID , 1837);
											$c->add(SerXPrpIhostPeer::PRP_ID , 2);
											SerXPrpIhostPeer::doDelete($c);
											
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(2,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(2);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(3,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(3);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(4,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(4);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(7,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(7);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(8,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(8);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(9,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(9);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(10,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(10);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(11,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(11);
									 			$s->setValor("indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(12,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(12);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(13,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(13);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(14,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(14);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(15,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(15);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(16,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(16);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(17,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(17);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(18,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(18);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(19,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(19);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(20,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(20);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(21,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(21);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(22,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(22);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(23,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(23);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
											$c=new Criteria();
											$c->add(FotosPeer::USR_ID , 1837);
											$c->add(FotosPeer::PRP_ID , 2);
											FotosPeer::doDelete($c);
											$propiedad->save();$propiedad=PropiedadesPeer::retrieveByPK(2,1837);if(!$propiedad){
												$propiedad=new Propiedades();
											}
									$propiedad->setPrpId(2);
								    $propiedad->setPrpDom("jejeje");
								    $propiedad->setPrpBar("");
								    $propiedad->setLocId(1);
								    $propiedad->setProId(21);
								    $propiedad->setPaiId(1);
								    $propiedad->setOriId(0);
								    $propiedad->setConId(3);
								    $propiedad->setFotos(0);
								    $propiedad->setPrpDesc("   ");
								    $propiedad->setUsrId(1837);
								    $propiedad->setTipId(7);
								    $propiedad->setPrpMod("2010-09-17");
								    $propiedad->setPrpAlta("2010-09-17");
								    $propiedad->setPrpNota("   ");
								    $propiedad->setPrpPre(3434);
								    $propiedad->setPrpMostrar(4);
								    $propiedad->setPrpPreDol(434);
								    $propiedad->setPrpCartel(0);
								    $propiedad->setPrpReferente(0);
								    $propiedad->setPublica(1);
								    $propiedad->setPrpServicios("   ");
								    $propiedad->setBarPrivId(0);
								    $propiedad->setPrpVip(0);
								    $propiedad->setMosPor1(1);
								    $propiedad->setMosPor2(1);
								    $propiedad->setMosPor3(1);
								    $propiedad->setMosPor4(0);
								    $propiedad->setPrpAnonimo(0);
								    $propiedad->setPrpLat("");
								    $propiedad->setPrpLng("");
								    
								    
								    
									
											$c=new Criteria();
											$c->add(SerXPrpIhostPeer::USR_ID , 1837);
											$c->add(SerXPrpIhostPeer::PRP_ID , 2);
											SerXPrpIhostPeer::doDelete($c);
											
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(2,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(2);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(3,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(3);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(4,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(4);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(7,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(7);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(8,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(8);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(9,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(9);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(10,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(10);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(11,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(11);
									 			$s->setValor("indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(12,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(12);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(13,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(13);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(14,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(14);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(15,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(15);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(16,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(16);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(17,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(17);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(18,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(18);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(19,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(19);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(20,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(20);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(21,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(21);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(22,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(22);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(23,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(23);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
											$c=new Criteria();
											$c->add(FotosPeer::USR_ID , 1837);
											$c->add(FotosPeer::PRP_ID , 2);
											FotosPeer::doDelete($c);
											$propiedad->save();$propiedad=PropiedadesPeer::retrieveByPK(1,1837);if(!$propiedad){
												$propiedad=new Propiedades();
											}
									$propiedad->setPrpId(1);
								    $propiedad->setPrpDom("dddddddd");
								    $propiedad->setPrpBar("");
								    $propiedad->setLocId(1);
								    $propiedad->setProId(21);
								    $propiedad->setPaiId(1);
								    $propiedad->setOriId(3);
								    $propiedad->setConId(2);
								    $propiedad->setFotos(0);
								    $propiedad->setPrpDesc(" ");
								    $propiedad->setUsrId(1837);
								    $propiedad->setTipId(7);
								    $propiedad->setPrpMod("2010-09-17");
								    $propiedad->setPrpAlta("2010-09-17");
								    $propiedad->setPrpNota(" ");
								    $propiedad->setPrpPre(0);
								    $propiedad->setPrpMostrar(4);
								    $propiedad->setPrpPreDol(0);
								    $propiedad->setPrpCartel(0);
								    $propiedad->setPrpReferente(0);
								    $propiedad->setPublica(1);
								    $propiedad->setPrpServicios(" ");
								    $propiedad->setBarPrivId(0);
								    $propiedad->setPrpVip(0);
								    $propiedad->setMosPor1(1);
								    $propiedad->setMosPor2(1);
								    $propiedad->setMosPor3(1);
								    $propiedad->setMosPor4(0);
								    $propiedad->setPrpAnonimo(0);
								    $propiedad->setPrpLat("");
								    $propiedad->setPrpLng("");
								    
								    
								    
									
											$c=new Criteria();
											$c->add(SerXPrpIhostPeer::USR_ID , 1837);
											$c->add(SerXPrpIhostPeer::PRP_ID , 1);
											SerXPrpIhostPeer::doDelete($c);
											
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(2,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(2);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(3,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(3);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(4,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(4);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(7,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(7);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(8,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(8);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(9,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(9);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(10,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(10);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(11,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(11);
									 			$s->setValor("indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(12,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(12);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(13,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(13);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(14,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(14);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(15,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(15);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(16,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(16);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(17,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(17);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(18,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(18);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(19,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(19);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(20,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(20);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(21,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(21);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(22,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(22);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(23,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(23);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
											$c=new Criteria();
											$c->add(FotosPeer::USR_ID , 1837);
											$c->add(FotosPeer::PRP_ID , 1);
											FotosPeer::doDelete($c);
											$propiedad->save();$propiedad=PropiedadesPeer::retrieveByPK(2,1837);if(!$propiedad){
												$propiedad=new Propiedades();
											}
									$propiedad->setPrpId(2);
								    $propiedad->setPrpDom("jejeje");
								    $propiedad->setPrpBar("");
								    $propiedad->setLocId(1);
								    $propiedad->setProId(21);
								    $propiedad->setPaiId(1);
								    $propiedad->setOriId(0);
								    $propiedad->setConId(3);
								    $propiedad->setFotos(0);
								    $propiedad->setPrpDesc("   ");
								    $propiedad->setUsrId(1837);
								    $propiedad->setTipId(7);
								    $propiedad->setPrpMod("2010-09-17");
								    $propiedad->setPrpAlta("2010-09-17");
								    $propiedad->setPrpNota("   ");
								    $propiedad->setPrpPre(3434);
								    $propiedad->setPrpMostrar(4);
								    $propiedad->setPrpPreDol(434);
								    $propiedad->setPrpCartel(0);
								    $propiedad->setPrpReferente(0);
								    $propiedad->setPublica(1);
								    $propiedad->setPrpServicios("   ");
								    $propiedad->setBarPrivId(0);
								    $propiedad->setPrpVip(0);
								    $propiedad->setMosPor1(1);
								    $propiedad->setMosPor2(1);
								    $propiedad->setMosPor3(1);
								    $propiedad->setMosPor4(0);
								    $propiedad->setPrpAnonimo(0);
								    $propiedad->setPrpLat("");
								    $propiedad->setPrpLng("");
								    
								    
								    
									
											$c=new Criteria();
											$c->add(SerXPrpIhostPeer::USR_ID , 1837);
											$c->add(SerXPrpIhostPeer::PRP_ID , 2);
											SerXPrpIhostPeer::doDelete($c);
											
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(2,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(2);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(3,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(3);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(4,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(4);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(7,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(7);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(8,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(8);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(9,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(9);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(10,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(10);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(11,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(11);
									 			$s->setValor("indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(12,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(12);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(13,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(13);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(14,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(14);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(15,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(15);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(16,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(16);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(17,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(17);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(18,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(18);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(19,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(19);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(20,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(20);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(21,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(21);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(22,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(22);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(23,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(23);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
											$c=new Criteria();
											$c->add(FotosPeer::USR_ID , 1837);
											$c->add(FotosPeer::PRP_ID , 2);
											FotosPeer::doDelete($c);
											$propiedad->save();$propiedad=PropiedadesPeer::retrieveByPK(1,1837);if(!$propiedad){
												$propiedad=new Propiedades();
											}
									$propiedad->setPrpId(1);
								    $propiedad->setPrpDom("dddddddd");
								    $propiedad->setPrpBar("");
								    $propiedad->setLocId(1);
								    $propiedad->setProId(21);
								    $propiedad->setPaiId(1);
								    $propiedad->setOriId(3);
								    $propiedad->setConId(2);
								    $propiedad->setFotos(0);
								    $propiedad->setPrpDesc(" ");
								    $propiedad->setUsrId(1837);
								    $propiedad->setTipId(7);
								    $propiedad->setPrpMod("2010-09-17");
								    $propiedad->setPrpAlta("2010-09-17");
								    $propiedad->setPrpNota(" ");
								    $propiedad->setPrpPre(0);
								    $propiedad->setPrpMostrar(4);
								    $propiedad->setPrpPreDol(0);
								    $propiedad->setPrpCartel(0);
								    $propiedad->setPrpReferente(0);
								    $propiedad->setPublica(1);
								    $propiedad->setPrpServicios(" ");
								    $propiedad->setBarPrivId(0);
								    $propiedad->setPrpVip(0);
								    $propiedad->setMosPor1(1);
								    $propiedad->setMosPor2(1);
								    $propiedad->setMosPor3(1);
								    $propiedad->setMosPor4(0);
								    $propiedad->setPrpAnonimo(0);
								    $propiedad->setPrpLat("");
								    $propiedad->setPrpLng("");
								    
								    
								    
									
											$c=new Criteria();
											$c->add(SerXPrpIhostPeer::USR_ID , 1837);
											$c->add(SerXPrpIhostPeer::PRP_ID , 1);
											SerXPrpIhostPeer::doDelete($c);
											
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(2,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(2);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(3,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(3);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(4,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(4);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(7,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(7);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(8,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(8);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(9,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(9);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(10,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(10);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(11,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(11);
									 			$s->setValor("indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(12,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(12);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(13,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(13);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(14,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(14);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(15,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(15);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(16,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(16);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(17,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(17);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(18,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(18);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(19,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(19);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(20,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(20);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(21,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(21);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(22,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(22);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(23,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(23);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
											$c=new Criteria();
											$c->add(FotosPeer::USR_ID , 1837);
											$c->add(FotosPeer::PRP_ID , 1);
											FotosPeer::doDelete($c);
											$propiedad->save();$propiedad=PropiedadesPeer::retrieveByPK(2,1837);if(!$propiedad){
												$propiedad=new Propiedades();
											}
									$propiedad->setPrpId(2);
								    $propiedad->setPrpDom("jejeje");
								    $propiedad->setPrpBar("");
								    $propiedad->setLocId(1);
								    $propiedad->setProId(21);
								    $propiedad->setPaiId(1);
								    $propiedad->setOriId(0);
								    $propiedad->setConId(3);
								    $propiedad->setFotos(0);
								    $propiedad->setPrpDesc("   ");
								    $propiedad->setUsrId(1837);
								    $propiedad->setTipId(7);
								    $propiedad->setPrpMod("2010-09-17");
								    $propiedad->setPrpAlta("2010-09-17");
								    $propiedad->setPrpNota("   ");
								    $propiedad->setPrpPre(3434);
								    $propiedad->setPrpMostrar(4);
								    $propiedad->setPrpPreDol(434);
								    $propiedad->setPrpCartel(0);
								    $propiedad->setPrpReferente(0);
								    $propiedad->setPublica(1);
								    $propiedad->setPrpServicios("   ");
								    $propiedad->setBarPrivId(0);
								    $propiedad->setPrpVip(0);
								    $propiedad->setMosPor1(1);
								    $propiedad->setMosPor2(1);
								    $propiedad->setMosPor3(1);
								    $propiedad->setMosPor4(0);
								    $propiedad->setPrpAnonimo(0);
								    $propiedad->setPrpLat("");
								    $propiedad->setPrpLng("");
								    
								    
								    
									
											$c=new Criteria();
											$c->add(SerXPrpIhostPeer::USR_ID , 1837);
											$c->add(SerXPrpIhostPeer::PRP_ID , 2);
											SerXPrpIhostPeer::doDelete($c);
											
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(2,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(2);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(3,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(3);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(4,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(4);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(7,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(7);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(8,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(8);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(9,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(9);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(10,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(10);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(11,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(11);
									 			$s->setValor("indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(12,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(12);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(13,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(13);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(14,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(14);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(15,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(15);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(16,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(16);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(17,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(17);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(18,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(18);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(19,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(19);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(20,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(20);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(21,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(21);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(22,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(22);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(23,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(23);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
											$c=new Criteria();
											$c->add(FotosPeer::USR_ID , 1837);
											$c->add(FotosPeer::PRP_ID , 2);
											FotosPeer::doDelete($c);
											$propiedad->save();$propiedad=PropiedadesPeer::retrieveByPK(1,1837);if(!$propiedad){
												$propiedad=new Propiedades();
											}
									$propiedad->setPrpId(1);
								    $propiedad->setPrpDom("dddddddd");
								    $propiedad->setPrpBar("");
								    $propiedad->setLocId(1);
								    $propiedad->setProId(21);
								    $propiedad->setPaiId(1);
								    $propiedad->setOriId(3);
								    $propiedad->setConId(2);
								    $propiedad->setFotos(0);
								    $propiedad->setPrpDesc(" ");
								    $propiedad->setUsrId(1837);
								    $propiedad->setTipId(7);
								    $propiedad->setPrpMod("2010-09-17");
								    $propiedad->setPrpAlta("2010-09-17");
								    $propiedad->setPrpNota(" ");
								    $propiedad->setPrpPre(0);
								    $propiedad->setPrpMostrar(4);
								    $propiedad->setPrpPreDol(0);
								    $propiedad->setPrpCartel(0);
								    $propiedad->setPrpReferente(0);
								    $propiedad->setPublica(1);
								    $propiedad->setPrpServicios(" ");
								    $propiedad->setBarPrivId(0);
								    $propiedad->setPrpVip(0);
								    $propiedad->setMosPor1(1);
								    $propiedad->setMosPor2(1);
								    $propiedad->setMosPor3(1);
								    $propiedad->setMosPor4(0);
								    $propiedad->setPrpAnonimo(0);
								    $propiedad->setPrpLat("");
								    $propiedad->setPrpLng("");
								    
								    
								    
									
											$c=new Criteria();
											$c->add(SerXPrpIhostPeer::USR_ID , 1837);
											$c->add(SerXPrpIhostPeer::PRP_ID , 1);
											SerXPrpIhostPeer::doDelete($c);
											
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(2,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(2);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(3,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(3);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(4,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(4);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(7,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(7);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(8,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(8);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(9,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(9);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(10,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(10);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(11,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(11);
									 			$s->setValor("indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(12,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(12);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(13,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(13);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(14,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(14);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(15,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(15);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(16,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(16);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(17,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(17);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(18,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(18);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(19,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(19);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(20,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(20);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(21,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(21);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(22,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(22);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(23,1,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(1);
									 			$s->setUsrId(1837);
									 			$s->setSerId(23);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
											$c=new Criteria();
											$c->add(FotosPeer::USR_ID , 1837);
											$c->add(FotosPeer::PRP_ID , 1);
											FotosPeer::doDelete($c);
											$propiedad->save();$propiedad=PropiedadesPeer::retrieveByPK(2,1837);if(!$propiedad){
												$propiedad=new Propiedades();
											}
									$propiedad->setPrpId(2);
								    $propiedad->setPrpDom("jejeje");
								    $propiedad->setPrpBar("");
								    $propiedad->setLocId(1);
								    $propiedad->setProId(21);
								    $propiedad->setPaiId(1);
								    $propiedad->setOriId(0);
								    $propiedad->setConId(3);
								    $propiedad->setFotos(0);
								    $propiedad->setPrpDesc("   ");
								    $propiedad->setUsrId(1837);
								    $propiedad->setTipId(7);
								    $propiedad->setPrpMod("2010-09-17");
								    $propiedad->setPrpAlta("2010-09-17");
								    $propiedad->setPrpNota("   ");
								    $propiedad->setPrpPre(3434);
								    $propiedad->setPrpMostrar(4);
								    $propiedad->setPrpPreDol(434);
								    $propiedad->setPrpCartel(0);
								    $propiedad->setPrpReferente(0);
								    $propiedad->setPublica(1);
								    $propiedad->setPrpServicios("   ");
								    $propiedad->setBarPrivId(0);
								    $propiedad->setPrpVip(0);
								    $propiedad->setMosPor1(1);
								    $propiedad->setMosPor2(1);
								    $propiedad->setMosPor3(1);
								    $propiedad->setMosPor4(0);
								    $propiedad->setPrpAnonimo(0);
								    $propiedad->setPrpLat("");
								    $propiedad->setPrpLng("");
								    
								    
								    
									
											$c=new Criteria();
											$c->add(SerXPrpIhostPeer::USR_ID , 1837);
											$c->add(SerXPrpIhostPeer::PRP_ID , 2);
											SerXPrpIhostPeer::doDelete($c);
											
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(2,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(2);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(3,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(3);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(4,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(4);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(7,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(7);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(8,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(8);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(9,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(9);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(10,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(10);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(11,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(11);
									 			$s->setValor("indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(12,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(12);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(13,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(13);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(14,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(14);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(15,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(15);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(16,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(16);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(17,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(17);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(18,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(18);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(19,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(19);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(20,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(20);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(21,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(21);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(22,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(22);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(23,2,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(2);
									 			$s->setUsrId(1837);
									 			$s->setSerId(23);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
											$c=new Criteria();
											$c->add(FotosPeer::USR_ID , 1837);
											$c->add(FotosPeer::PRP_ID , 2);
											FotosPeer::doDelete($c);
											$propiedad->save();$propiedad=PropiedadesPeer::retrieveByPK(3,1837);if(!$propiedad){
												$propiedad=new Propiedades();
											}
									$propiedad->setPrpId(3);
								    $propiedad->setPrpDom("sdfsdf");
								    $propiedad->setPrpBar("");
								    $propiedad->setLocId(15);
								    $propiedad->setProId(21);
								    $propiedad->setPaiId(1);
								    $propiedad->setOriId(0);
								    $propiedad->setConId(1);
								    $propiedad->setFotos(0);
								    $propiedad->setPrpDesc(" ");
								    $propiedad->setUsrId(1837);
								    $propiedad->setTipId(3);
								    $propiedad->setPrpMod("2010-09-17");
								    $propiedad->setPrpAlta("2010-09-17");
								    $propiedad->setPrpNota(" ");
								    $propiedad->setPrpPre(343);
								    $propiedad->setPrpMostrar(4);
								    $propiedad->setPrpPreDol(43);
								    $propiedad->setPrpCartel(0);
								    $propiedad->setPrpReferente(0);
								    $propiedad->setPublica(1);
								    $propiedad->setPrpServicios(" ");
								    $propiedad->setBarPrivId(0);
								    $propiedad->setPrpVip(0);
								    $propiedad->setMosPor1(1);
								    $propiedad->setMosPor2(1);
								    $propiedad->setMosPor3(1);
								    $propiedad->setMosPor4(0);
								    $propiedad->setPrpAnonimo(0);
								    $propiedad->setPrpLat("");
								    $propiedad->setPrpLng("");
								    
								    
								    
									
											$c=new Criteria();
											$c->add(SerXPrpIhostPeer::USR_ID , 1837);
											$c->add(SerXPrpIhostPeer::PRP_ID , 3);
											SerXPrpIhostPeer::doDelete($c);
											
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(2,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(2);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(3,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(3);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(4,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(4);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(7,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(7);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(8,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(8);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(9,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(9);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(10,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(10);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(11,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(11);
									 			$s->setValor("indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(12,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(12);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(13,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(13);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(14,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(14);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(15,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(15);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(16,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(16);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(17,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(17);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(18,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(18);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(19,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(19);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(20,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(20);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(21,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(21);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(22,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(22);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(23,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(23);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
											$c=new Criteria();
											$c->add(FotosPeer::USR_ID , 1837);
											$c->add(FotosPeer::PRP_ID , 3);
											FotosPeer::doDelete($c);
											$propiedad->save();$propiedad=PropiedadesPeer::retrieveByPK(3,1837);if(!$propiedad){
												$propiedad=new Propiedades();
											}
									$propiedad->setPrpId(3);
								    $propiedad->setPrpDom("sdfsdf");
								    $propiedad->setPrpBar("");
								    $propiedad->setLocId(15);
								    $propiedad->setProId(21);
								    $propiedad->setPaiId(1);
								    $propiedad->setOriId(0);
								    $propiedad->setConId(1);
								    $propiedad->setFotos(0);
								    $propiedad->setPrpDesc(" ");
								    $propiedad->setUsrId(1837);
								    $propiedad->setTipId(3);
								    $propiedad->setPrpMod("2010-09-17");
								    $propiedad->setPrpAlta("2010-09-17");
								    $propiedad->setPrpNota(" ");
								    $propiedad->setPrpPre(343);
								    $propiedad->setPrpMostrar(4);
								    $propiedad->setPrpPreDol(43);
								    $propiedad->setPrpCartel(0);
								    $propiedad->setPrpReferente(0);
								    $propiedad->setPublica(1);
								    $propiedad->setPrpServicios(" ");
								    $propiedad->setBarPrivId(0);
								    $propiedad->setPrpVip(0);
								    $propiedad->setMosPor1(1);
								    $propiedad->setMosPor2(1);
								    $propiedad->setMosPor3(1);
								    $propiedad->setMosPor4(0);
								    $propiedad->setPrpAnonimo(0);
								    $propiedad->setPrpLat("");
								    $propiedad->setPrpLng("");
								    
								    
								    
									
											$c=new Criteria();
											$c->add(SerXPrpIhostPeer::USR_ID , 1837);
											$c->add(SerXPrpIhostPeer::PRP_ID , 3);
											SerXPrpIhostPeer::doDelete($c);
											
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(2,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(2);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(3,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(3);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(4,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(4);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(7,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(7);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(8,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(8);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(9,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(9);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(10,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(10);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(11,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(11);
									 			$s->setValor("indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(12,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(12);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(13,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(13);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(14,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(14);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(15,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(15);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(16,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(16);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(17,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(17);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(18,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(18);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(19,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(19);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(20,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(20);
									 			$s->setValor("");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(21,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(21);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(22,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(22);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
										
									 			$s=SerXPrpIhostPeer::retrieveByPK(23,3,1837);
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId(3);
									 			$s->setUsrId(1837);
									 			$s->setSerId(23);
									 			$s->setValor("Indistinto");
									 			$propiedad->addSerXPrpIhost($s);
									 		
											$c=new Criteria();
											$c->add(FotosPeer::USR_ID , 1837);
											$c->add(FotosPeer::PRP_ID , 3);
											FotosPeer::doDelete($c);
											$propiedad->save();
									$usuarios=get_usuarios($usr_id);
									for($i=0;$i<count($usuarios);$i++){
							mysql_query("insert into cam_red_cim values($usuarios[$i],0,1837)");
}
								
							
						
						
						?>
							<script language="javascript">
									location.href="../act_inmohost.php?usr_id=<?print $usr_id?>&ip=<?print $ip?>&e=<?print $e?>";
							</script>
						
						<?
					
					
					?>
				