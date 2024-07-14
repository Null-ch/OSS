import React from 'react';
import './order.css';
import Price from '../../components/util/Price';

const OrderItems = ({items}) => {
    let rows = [];
    let totalPrice = 0;

    for (let id in items || {}) {
        let item = items[id];
        
        let total = item.count * item.product.price;
        totalPrice += total;

        rows.push(
        <tr>
            <td>{item.product.title}</td>
            <td>{item.product.price}</td>
            <td>{item.count}</td>
            <td className = 'o-i-t-sum'>{total}</td>
        </tr>
        );
    }

    // console.log(rows);

    return (
        <div className = 'order-items'>
            <table className = 'o-i-table'>
                <tr>
                    <th>Название</th>
                    <th>Цена</th>
                    <th>Количество</th>
                    <th>Сумма</th>
                </tr>
                {rows}
            </table>
            <div className = 'order-shipping-price'>
                <span>Доставка:</span>
                <span className = 'o-s-p-result'>Введите адрес</span>
            </div>
            <div className = 'order-subtotal'>
                <span>Итого:</span>
                <Price className = 'o-s-total-price' price = {totalPrice} title = 'Сумма'/>
            </div>
        </div>
    );
};

export default OrderItems;