

export default function({ width, height, fillColor, Span, rotate, onClick, className }) {
    return (
        <div className={className}>
            <svg
            onClick={onClick}
            width={width}
            height={height}
            fill={fillColor}
            transform={'rotate('+rotate+')'}
            xmlns="http://www.w3.org/2000/svg"
            viewBox="5.98 27.97 88.06 44.04">
                <path d="M50.281 1024.36a4 4 0 0 0 2.407-1l40-36a4.016 4.016 0 1 0-5.375-5.968L50 1014.985l-37.313-33.593a4.016 4.016 0 1 0-5.375 5.969l40 36a4 4 0 0 0 2.97 1z"
                transform="translate(0 -952.362)"
                />
            </svg>
            {Span}
        </div>
    );
  }
<svg xmlns="http://www.w3.org/2000/svg" ></svg>