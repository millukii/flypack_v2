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
13. Tomar la empresa del usuario al crear orden de transporte
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
27. Revisar en agregar orden que la compañia y el estado no se estan enviando a la bd
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
    ´´´´