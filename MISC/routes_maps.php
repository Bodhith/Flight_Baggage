<?php

  /*function completeRoute()
  {
    $allRoutes =
    array(                  //      <= array of airports
      0=>array(             //      <= curr. airport
        1=>array(           //      <= dest. airport
          0=>array(         //      <= checkIn
            0=>array(       //      <= security check
              "junctions"=>array(
                0, 2, 3
              ),
              "gate"=>array(
                1=>array(
                  "collectionCarousel"=>(
                    1=>array(
                      "exitGate"=>array(
                        1
                      )
                    )
                  )
                )
              ),
              "plane"=>array(
                1
              )
            )
          ),
          1=>array(
            1=>array(
              "junctions"=>array(
                2, 3
              ),
              "gate"=>array(
                1=>array(
                  "collectionCarousel"=>(
                    1=>array(
                      "exitGate"=>array(
                        1
                      )
                    )
                  )
                )
              ),
              "plane"=>array(
                1
              )
            )
          )
        ),
      ),
      1=>array(             //      <= curr. airport
        0=>array(           //      <= dest. airport
          0=>array(         //      <= checkIn
            0=>array(       //      <= security check
              "junctions"=>array(
                0, 2, 3
              ),
              "gate"=>array(
                1
              ),
              "plane"=>array(
                1
              )
            )
          ),
          1=>array(
            1=>array(
              "junctions"=>array(
                2, 3
              ),
              "gate"=>array(
                1
              ),
              "plane"=>array(
                1
              )
            )
          )
        ),
      )
    );
  }

  function getCheckInToGateRoute()
  {
    $checkInToGateRoute = array(
           0=>array(                                  //    airport
              0=>array(                               //    check in
                  0=>array(                           //    to gate
                    "securityCheck"=>array(
                      0
                    ),
                    "junctions"=>array(
                      0, 1
                    )
                  ),
                  1=>array(
                    "securityCheck"=>array(
                      1
                    ),
                    "junctions"=>array(
                      0, 2, 3
                    )
                  )
                ),
              1=>array(
                  0=>array(
                    "securityCheck"=>array(
                      1
                    ),
                    "junctions"=>array(
                      2, 0, 1
                    )
                  ),
                  1=>array(
                    "securityCheck"=>array(
                      1
                    ),
                    "junctions"=>array(
                      2, 3
                    )
                  )
                )
              ),
          1=>array(                                  //    airport
             0=>array(                               //    check in
                 0=>array(                           //    to gate
                   "securityCheck"=>array(
                     0
                   ),
                   "junctions"=>array(
                     0, 1
                   )
                 ),
                 1=>array(
                   "securityCheck"=>array(
                     1
                   ),
                   "junctions"=>array(
                     0, 2, 3
                   )
                 )
               ),
             1=>array(
                 0=>array(
                   "securityCheck"=>array(
                     1
                   ),
                   "junctions"=>array(
                     2, 0, 1
                   )
                 ),
                 1=>array(
                   "securityCheck"=>array(
                     1
                   ),
                   "junctions"=>array(
                     2, 3
                   )
                 )
               )
             )
   );

   return $checkInToGateRoute;

  }

  function getGateToExitGateRoute()
  {
    $gateToCollectionCarouselRoute = array(
      0=>array(                               //    airport
        0=>array(                             //    gate
          "collectionCarousel"=>array(
            0
          ),
          "exitGate"=>array(
            0
          )
        ),
        1=>array(
          "collectionCarousel"=>array(
            1
          ),
          "exitGate"=>array(
            0
          )
        )
      ),
     1=>array(
       0=>array(
         "collectionCarousel"=>array(
           0
         ),
         "exitGate"=>array(
           0
         )
       ),
       1=>array(
         "collectionCarousel"=>array(
           1
         ),
         "exitGate"=>array(
           0
         )
       )
     )
    );

    return $gateToCollectionCarouselRoute;
  }

  function getGateToPlaneMap()
  {
    $gateToPlaneMap = array(
      0=>array(                     //    airport
        0=>array(                  //     gate
          0                       //    plane
        ),
        1=>array(
          1
        )
      ),
      1=>array(                     //    airport
        0=>array(                  //     gate
          0                       //    plane
        ),
        1=>array(
          1
        )
      )
    );

    return $gateToPlaneMap;
  }

  function getPlaneToDestinationGateMap()
  {
    $planeToDestinationGateMap = array(
      0=>array(                         //    curr. airport
        0=>array(                     //     plane
          1=>array(                 //      dest. airport
            0                     //       gate
          )
        ),
        1=>array(
          1=>array(
            1
          )
        ),
    1=>array(                         //    curr. airport
      0=>array(                     //     plane
        0=>array(                 //      dest. airport
          0                     //       gate
        )
      ),
      1=>array(
        0=>array(
          1
        )
      )
    )
   )
  );

    return $planeToDestinationGateMap;
  }*/

 ?>
