import React from "react"
// import { Context } from "../../utils/context";

interface IButtonProps extends React.ButtonHTMLAttributes<HTMLButtonElement> {
    // customProps
    variant: 'default' | 'login' | 'simpleSwitch'
    icon?: React.ReactNode
    iconPosition?: 'left' | 'right' | 'top' | 'bottom'
    iconColor?: string
    text?: string
    textColor?: string
    route?: string
    className?: string
    onClick(): void,
    bubble: React.ReactNode,
}

const Button = (props: IButtonProps) => {
    // const {logIn, logOut} = useContext(Context)
    // console.log(props)

    const {
        variant, icon, iconPosition, iconColor, text, textColor, route, className, onClick, disabled, bubble,
        ...restProps
    } = props;
    
    let direction: string
    direction = 'row'
    switch(iconPosition) {
        case 'left': direction = 'row'; break
        case 'right': direction = 'row-reverse'; break
        case 'top': direction = 'column'; break
        case 'bottom': direction = 'column-reverse'; break
        default: direction = 'row'
    }

    return (
        <div className = 'button-container'>
            <a href = {route}>
                <button disabled = {disabled} onClick={onClick} className={className} style={{gap: !text ? 0 : 8, display: 'flex', flexDirection: direction as 'row'}} {...restProps}>
                    {icon}
                    <span>
                        {text}
                    </span>
                </button>
            </a>
            {bubble}
        </div>
    );
};

export default Button