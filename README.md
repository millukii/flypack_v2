## flypack_v2



## TODO

1. Compañias crud Done
2. Revisar error rut Personas, Empresas Done
3. Crear personas, empresas y usuarios por cada rol Done
4. Login  Done
5. Configurar que ve cada tipo de usuarios Done
6. Cliente: ordenes de transporte, precios y etiquetas
7. Repartidor: Mis envios Filtro de fechas listado (Mel)
8. Menu Precios Done
9. Etiquetas(quadmins) (Mati)
10. Reporte Ordenes de transporte (Mati)
11. Accesos directos (Mel)
12. Invisibilizar codigo quadmins dejar como null y ocultar de las vistas Done
13. Tomar la empresa del usuario al crear orden de transporte done
14. Cambiar representante legal a contacto Done
15. Select reprentante legal agregar digito verificador Done
16. Agregar monto en orden de transporte Done
17. Agregar select origen y destino orden de transporte Done (caja de texto)
18. ShippingType de orden de transporte convertirlo en select X, L, M Done
19. Aplicar precio sugerido que se encuentre en la tabla rates
20. Dejar edit ot igual al add pero con edicion del estado
21. Agregar boton para editar de usuarios que inicia sesión, todos menos el campo "user". (mati) (DONE)
22. Al momento de que se cree un usuario, generar una constraseña aleatoria y mande un correo al usuario con sus datos para iniciar sesion. (mati) (DONE)
23. Mejorar interfaz login (mel) Done
24. Agregar hipervinculo de: ¿has olvidado tu contraseña? en el login (mel) 
25. Agregar Consumo de endpoint POST para que al crear una orden se cree su homologo en quadmin.
26. Las ordenes en quadmin se crean por separado en su cuerpo genérico y su detalle. El detalle se compone de ítems.
27. Revisar en agregar orden que la compañia y el estado no se estan enviando a la bd done
28. Editar Envio (campos editables,todos excepto company y user) done
29. Eliminar clases obsoletas Done
30. Formatear identacion php, html Done
31. Agregar ajax operacion obtener los precios por tamaño add, edit shipping Errores
32. Validar que se calculen totalAmount add y edit shipping No funciona
33. Agregar boton icono de qr, para generar etiqueta
34. Quitar menus de etiquetas en el index y en sidebar Done

## Vistas

- Cliente:  OT(solo de la empresa que inicia sesion), Precios, Etiquetas
- Repartidor:  OT(solo del repartidor que inicia sesion )
- Administrador: Todo



## Crear Orden

- Tipo=PEDIDO-RETIRO
- poiId==punto de interes Ejemplo _id: 121245261 121541228
- code
- date
- label
- priority 0-9
- totalAmount
- totalWithoutTaxes
- orderItems
    - productId 55982864
    - quantity 12
    - unitPrice 12

    ´´´´
{
  "meta": {
    "errors": []
  },
  "data": [
    {
      "_id": 258863437,
      "poiId": 121245261,
      "userId": 23735,
      "code": "12",
      "label": "343434",
      "assignmentOutput": 0,
      "date": "2022-01-01",
      "totalAmount": 10,
      "totalAmountWithoutTaxes": 8,
      "waypointId": null,
      "priority": 9,
      "deletedAt": null,
      "operation": "PEDIDO",
      "qtn": null,
      "orderItems": [
        {
          "_id": 1039343,
          "orderId": 258863437,
          "productId": 55982864,
          "productCode": "",
          "quantity": 2,
          "deliveredQuantity": 0,
          "unitPrice": 10
        }
      ],
      "orderMeasures": [
        {
          "_id": 5430766,
          "orderId": 258863437,
          "constraintId": 2,
          "value": 0
        },
        {
          "_id": 5430767,
          "orderId": 258863437,
          "constraintId": 3,
          "value": 0
        },
        {
          "_id": 5430768,
          "orderId": 258863437,
          "constraintId": 7,
          "value": 0
        },
        {
          "_id": 5430769,
          "orderId": 258863437,
          "constraintId": 11,
          "value": 0
        }
      ],
      "merchants": []
    }
  ]
}

## TODO
28. OTs en el listado remover atributos (mel)
29. OTs atributo tipo = tamaño (mel)
30. OTs atributo delivery = repartidor, corresponde nombre completo del repartidor (sale de usuarios con rol repartidor) (mel)
31. OTs al agregar, considerar campos que se esten pre cargados:
  - origen = es un selector con la comuna de origen de la empresa. (mel)
  - para origen considerar empresas que puedan tener sucursales, a lo cual habría que listar dichas comunas de sucursales. (mel) Done
32. El total se calcula dependiendo si la empresa posee tarifa por (origen  a destino) o (tamaño), para eso existe un campo en la bd que se llama type_rate [1 = origen a destino, 2 = tamaño]. Por ende el precio no es ingresado a mano, si no que se calcula en base a la matriz de precios ya sea de origen destino o por tamaño. (mel) Done
33. Condiciones en la creacion de OT
- Si la orden de transporte se ingresa antes de las 22:00 GMT -3 se considera que la orden será parte de la planificación para el siguiente día, de lo contrario, se pasará a la del día sub siguiente.
- Días hábiles de flypack Lunes-Sábado
34. Autocompletado sugerido para la dirección de la ot dirección final, a partir de los POId del cliente.
35. La orden de compra debe crearse por defecto como RETIRO.
36. Los estados son ENTREGA y RETIRO.
37. Escribir en notas de quadmin el campo observación.
38. Habilitar editar OT en Quadmin.
39. 
