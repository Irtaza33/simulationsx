//level 
                $dd = $count1+1; //3 - 25
                $ll = $dd-2; // 1 -23
                $bg = $ll+1; //2 - 24
                $lk = $dd+1; //4 - 26
                $lm = $dd-13; //4 - 26

                $select_alpa = mysqli_query($con,"select * from team_input where team_id = '".$team_id."' AND session_id = '".$session_id."' ");
                $fts=mysqli_fetch_array($select_alpa);
                $select_fr4=mysqli_query($con,"select * from forecast_data where team_id = '".$team_id."' AND comp_id = '".$company."' AND ser_num = '".$dd."' ");
                $fetch_fr4 = mysqli_fetch_array($select_fr4);
                $C_data =  $fetch_fr4['data'];

                $alpha =  $fts['input_alpha'];
                $beta =  $fts['input_beta'];
                $gama =  $fts['input_gama'];

                if($ll < 11){
                    $level[] = 0;
                    $smtnd[] = 0;
                }elseif($ll == 11){

                    $level[] = round($C_data / $season[0]);
                    $smtnd[] = round(($level[12] - $C_data)/$season[11]);

                }else{

                $G_data = $season[$lm];

                 if($ll == 13){
                    $E_data = $level[12]; // D18 data
                    $F_data =  $smtnd[12];

                }else{
                    $E_data = $forumula; // D18 data
                    $F_data = $forumula2;
                }

                $formula = $alpha * ($C_data / $G_data) + (1 - $alpha) * ($E_data + $F_data) ; //for E formula



                    $level[] = round($formula);
                    $smtnd[] = 2;
                }
                    //level 

                   
                    //Sesion
                    if($bg <= 12){
                        $season[]= round($fetch_fr['actual_data'] / $C_avg,2);
                    }else{
                        // $fetch_fr4['data']; C data
                        $fv = $bg-12;
                        $season[] = $season[$fv]; 
                       
                    }
                    //Sesion