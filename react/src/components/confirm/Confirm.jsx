import Button from "../buttons/Button";
import './../../styles/common.css'
import XIcon from "../icons/XIcon";

export function Confirm({ text, header, okText = 'OK', cancelText = 'Отмена', onOk, onClose }) {
    // const dispatch = useDispatch();

    return (
        <div className = 'popup-container-default'>
            <span className = 'popup-header-default'>{ header }</span>
            <span className = 'popup-text-default'>{ text }</span>
            <div className = 'popup-buttons-container'>
                <Button
                    disabled = {false}
                    className = 'button-default-hover'
                    title = {okText}
                    text = {okText}
                    onClick = {onOk}
                />
                <Button
                    disabled = {false}
                    className = 'button-default-hover'
                    title = {cancelText}
                    text = {cancelText}
                    onClick = {onClose}
                />
            </div>
            <XIcon
                className = 'popup-default-x'
                title = 'Закрыть'
                onClick = { onClose }
                width = '12'
                height = '12'
                fillColor = '#333'
            />
        </div>
    );
}

export default Confirm;
