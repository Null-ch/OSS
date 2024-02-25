import { createSlice } from '@reduxjs/toolkit';

const modalSlice = createSlice({
    name: 'modal',
    initialState: {
        data: [],
        isModalVisible: false,
        content: null,
    },
    reducers: {
        setModalData(state, action) {
            state.data = action.payload;
        },
        setIsModalVisible(state, action) {
            console.log('setIsModalVisible')
            state.isModalVisible = action.payload;
        },
        setContent(state, action) {
            console.log('setContent')
            state.content = action.payload;
        }
    }

})

export const {setModalData, setIsModalVisible, setContent} = modalSlice.actions;
export default modalSlice.reducer;