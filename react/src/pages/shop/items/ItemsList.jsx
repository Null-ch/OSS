import React from 'react';
import Item from './ItemPreview';
import './items.css';
import { useEffect } from 'react';
import '../../../components/modal/modal.css'
import ItemQuickBuy from './ItemQuickBuy';
import { setIsModalVisible, setModalData, setContent } from '../../../store/modalSlice';
import { useDispatch, useSelector } from 'react-redux';

const ItemsList = ({items}) => {
    const dispatch = useDispatch();

    useEffect(() => {
        dispatch(setContent(<ItemQuickBuy/>));
      }, []);

    const showModal = (data) => {
        dispatch(setModalData(data));
        dispatch(setIsModalVisible(true));
    }
    // console.log(data)
    // console.log(items)
    return (
        <div className = 'items'>
            {(items || []).map((item) => {
                return <Item
                    onQuickBuyClick = {(item) => {
                        showModal(item);
                    }}
                    // onClick = {(e) => {
                    //     console.log(item);
                    // }}
                    item = {item}
                    key = {item.id}
                />
            })}
        </div>
    );
};

export default ItemsList;