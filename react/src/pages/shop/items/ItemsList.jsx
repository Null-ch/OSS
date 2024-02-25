import React from 'react';
import Item from './Item';
import './items.css';
import { useEffect } from 'react';
import '../../../components/modal/modal.css'
import ItemQuickBuy from './ItemQuickBuy';
import { setIsModalVisible, setModalData, setContent } from '../../../store/modalSlice';
import { useDispatch, useSelector } from 'react-redux';

const ItemsList = ({items}) => {
    const dispatch = useDispatch();
    const {data: data} = useSelector((state) => state.modal);

    useEffect(() => {
        dispatch(setContent(<ItemQuickBuy/>));
      }, []);

    const showModal = (data) => {
        dispatch(setModalData(data));
        dispatch(setIsModalVisible(true));
    }

    return (
        <>
            <div className = 'items'>
                {items.map((item) => {
                    return <Item
                    onQuickBuyClick = {(item) => {
                        showModal(item);
                    }}
                    item = {item}
                    key = {item.id}
                    />
                })}
            </div>
        </>

    );
};

export default ItemsList;