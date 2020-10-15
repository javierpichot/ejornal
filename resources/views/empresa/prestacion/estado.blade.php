@if ($prestacion_pedido->estado == 1)
     Pendiente de realizar cotizaciones

 @elseif ($prestacion_pedido->estado == 2)
     Pendiente de realizar presupesto
 @elseif ($prestacion_pedido->estado == 3)
     Perdiente de confirmacion presupesto
 @elseif ($prestacion_pedido->estado == 4)
         Pendiente de realizar orden de servicio
     @elseif ($prestacion_pedido->estado == 5)
         En ejecucion
     @elseif ($prestacion_pedido->estado == 6)
         Pendiente de confirmar reporte de servicio
     @elseif ($prestacion_pedido->estado == 7)
         Okey todo perfecto
     @elseif ($prestacion_pedido->estado == 8)
         Presupuesto rechazado
     @elseif ($prestacion_pedido->estado == 9)
             Reporte de servicio rechazado
         @elseif ($prestacion_pedido->estado == 10)
                 Prestación completada satisfactoriamente
 @endif
