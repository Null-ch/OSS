<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            [
                'title' => 'IndianRed',
                'group' => 'Red',
                'hex_code' => '#CD5C5C',
                'rgb_code' => '205, 92, 92'
            ],
            [
                'title' => 'LightCoral',
                'group' => 'Red',
                'hex_code' => '#F08080',
                'rgb_code' => '240, 128, 128'
            ],
            [
                'title' => 'Salmon',
                'group' => 'Red',
                'hex_code' => '#FA8072',
                'rgb_code' => '250, 128, 114'
            ],
            [
                'title' => 'DarkSalmon',
                'group' => 'Red',
                'hex_code' => '#E9967A',
                'rgb_code' => '233, 150, 122'
            ],
            [
                'title' => 'LightSalmon',
                'group' => 'Red',
                'hex_code' => '#FFA07A',
                'rgb_code' => '255, 160, 122'
            ],
            [
                'title' => 'Crimson',
                'group' => 'Red',
                'hex_code' => '#DC143C',
                'rgb_code' => '220, 20, 60'
            ],
            [
                'title' => 'Red',
                'group' => 'Red',
                'hex_code' => '#FF0000',
                'rgb_code' => '255, 0, 0'
            ],
            [
                'title' => 'FireBrick',
                'group' => 'Red',
                'hex_code' => '#B22222',
                'rgb_code' => '178, 34, 34'
            ],
            [
                'title' => 'DarkRed',
                'group' => 'Red',
                'hex_code' => '#8B0000',
                'rgb_code' => '139, 0, 0'
            ],
            [
                'title' => 'Pink',
                'group' => 'Pink',
                'hex_code' => '#FFC0CB',
                'rgb_code' => '255, 192, 203'
            ],
            [
                'title' => 'LightPink',
                'group' => 'Pink',
                'hex_code' => '#FFB6C1',
                'rgb_code' => '255, 182, 193'
            ],
            [
                'title' => 'HotPink',
                'group' => 'Pink',
                'hex_code' => '#FF69B4',
                'rgb_code' => '255, 105, 180'
            ],
            [
                'title' => 'DeepPink',
                'group' => 'Pink',
                'hex_code' => '#FF1493',
                'rgb_code' => '255, 20, 147'
            ],
            [
                'title' => 'MediumVioletRed',
                'group' => 'Pink',
                'hex_code' => '#C71585',
                'rgb_code' => '199, 21, 133'
            ],
            [
                'title' => 'PaleVioletRed',
                'group' => 'Pink',
                'hex_code' => '#DB7093',
                'rgb_code' => '219, 112, 147'
            ],
            [
                'title' => 'LightSalmon',
                'group' => 'Orange',
                'hex_code' => '#FFA07A',
                'rgb_code' => '255, 160, 122'
            ],
            [
                'title' => 'Coral',
                'group' => 'Orange',
                'hex_code' => '#FF7F50',
                'rgb_code' => '255, 127, 80'
            ],
            [
                'title' => 'Tomato',
                'group' => 'Orange',
                'hex_code' => '#FF6347',
                'rgb_code' => '255, 99, 71'
            ],
            [
                'title' => 'OrangeRed',
                'group' => 'Orange',
                'hex_code' => '#FF4500',
                'rgb_code' => '255, 69, 0'
            ],
            [
                'title' => 'DarkOrange',
                'group' => 'Orange',
                'hex_code' => '#FF8C00',
                'rgb_code' => '255, 140, 0'
            ],
            [
                'title' => 'Orange',
                'group' => 'Orange',
                'hex_code' => '#FFA500',
                'rgb_code' => '255, 165, 0'
            ],
            [
                'title' => 'Gold',
                'group' => 'Yellow',
                'hex_code' => '#FFD700',
                'rgb_code' => '255, 215, 0'
            ],
            [
                'title' => 'Yellow',
                'group' => 'Yellow',
                'hex_code' => '#FFFF00',
                'rgb_code' => '255, 255, 0'
            ],
            [
                'title' => 'LightYellow',
                'group' => 'Yellow',
                'hex_code' => '#FFFFE0',
                'rgb_code' => '255, 255, 224'
            ],
            [
                'title' => 'LemonChiffon',
                'group' => 'Yellow',
                'hex_code' => '#FFFACD',
                'rgb_code' => '255, 250, 205'
            ],
            [
                'title' => 'LightGoldenrodYellow',
                'group' => 'Yellow',
                'hex_code' => '#FAFAD2',
                'rgb_code' => '250, 250, 210'
            ],
            [
                'title' => 'PapayaWhip',
                'group' => 'Yellow',
                'hex_code' => '#FFEFD5',
                'rgb_code' => '255, 239, 213'
            ],
            [
                'title' => 'Moccasin',
                'group' => 'Yellow',
                'hex_code' => '#FFE4B5',
                'rgb_code' => '255, 228, 181'
            ],
            [
                'title' => 'PeachPuff',
                'group' => 'Yellow',
                'hex_code' => '#FFDAB9',
                'rgb_code' => '255, 218, 185'
            ],
            [
                'title' => 'PaleGoldenrod',
                'group' => 'Yellow',
                'hex_code' => '#EEE8AA',
                'rgb_code' => '238, 232, 170'
            ],
            [
                'title' => 'Khaki',
                'group' => 'Yellow',
                'hex_code' => '#F0E68C',
                'rgb_code' => '240, 230, 140'
            ],
            [
                'title' => 'DarkKhaki',
                'group' => 'Yellow',
                'hex_code' => '#BDB76B',
                'rgb_code' => '189, 183, 107'
            ],
            [
                'title' => 'Lavender',
                'group' => 'Purple',
                'hex_code' => '#E6E6FA',
                'rgb_code' => '230, 230, 250'
            ],
            [
                'title' => 'Thistle',
                'group' => 'Purple',
                'hex_code' => '#D8BFD8',
                'rgb_code' => '216, 191, 216'
            ],
            [
                'title' => 'Plum',
                'group' => 'Purple',
                'hex_code' => '#DDA0DD',
                'rgb_code' => '221, 160, 221'
            ],
            [
                'title' => 'Violet',
                'group' => 'Purple',
                'hex_code' => '#EE82EE',
                'rgb_code' => '238, 130, 238'
            ],
            [
                'title' => 'Orchid',
                'group' => 'Purple',
                'hex_code' => '#DA70D6',
                'rgb_code' => '218, 112, 214'
            ],
            [
                'title' => 'Fuchsia',
                'group' => 'Purple',
                'hex_code' => '#FF00FF',
                'rgb_code' => '255, 0, 255'
            ],
            [
                'title' => 'Magenta',
                'group' => 'Purple',
                'hex_code' => '#FF00FF',
                'rgb_code' => '255, 0, 255'
            ],
            [
                'title' => 'MediumOrchid',
                'group' => 'Purple',
                'hex_code' => '#BA55D3',
                'rgb_code' => '186, 85, 211'
            ],
            [
                'title' => 'MediumPurple',
                'group' => 'Purple',
                'hex_code' => '#9370DB',
                'rgb_code' => '147, 112, 219'
            ],
            [
                'title' => 'BlueViolet',
                'group' => 'Purple',
                'hex_code' => '#8A2BE2',
                'rgb_code' => '138, 43, 226'
            ],
            [
                'title' => 'DarkViolet',
                'group' => 'Purple',
                'hex_code' => '#9400D3',
                'rgb_code' => '148, 0, 211'
            ],
            [
                'title' => 'DarkOrchid',
                'group' => 'Purple',
                'hex_code' => '#9932CC',
                'rgb_code' => '153, 50, 204'
            ],
            [
                'title' => 'DarkMagenta',
                'group' => 'Purple',
                'hex_code' => '#8B008B',
                'rgb_code' => '139, 0, 139'
            ],
            [
                'title' => 'Purple',
                'group' => 'Purple',
                'hex_code' => '#800080',
                'rgb_code' => '128, 0, 128'
            ],
            [
                'title' => 'Indigo',
                'group' => 'Purple',
                'hex_code' => '#4B0082',
                'rgb_code' => '75, 0, 130'
            ],
            [
                'title' => 'SlateBlue',
                'group' => 'Purple',
                'hex_code' => '#6A5ACD',
                'rgb_code' => '106, 90, 205'
            ],
            [
                'title' => 'DarkSlateBlue',
                'group' => 'Purple',
                'hex_code' => '#483D8B',
                'rgb_code' => '72, 61, 139'
            ],
            [
                'title' => 'Cornsilk',
                'group' => 'Brown',
                'hex_code' => '#FFF8DC',
                'rgb_code' => '255, 248, 220'
            ],
            [
                'title' => 'BlanchedAlmond',
                'group' => 'Brown',
                'hex_code' => '#FFEBCD',
                'rgb_code' => '255, 235, 205'
            ],
            [
                'title' => 'Bisque',
                'group' => 'Brown',
                'hex_code' => '#FFE4C4',
                'rgb_code' => '255, 228, 196'
            ],
            [
                'title' => 'NavajoWhite',
                'group' => 'Brown',
                'hex_code' => '#FFDEAD',
                'rgb_code' => '255, 222, 173'
            ],
            [
                'title' => 'Wheat',
                'group' => 'Brown',
                'hex_code' => '#F5DEB3',
                'rgb_code' => '245, 222, 179'
            ],
            [
                'title' => 'BurlyWood',
                'group' => 'Brown',
                'hex_code' => '#DEB887',
                'rgb_code' => '222, 184, 135'
            ],
            [
                'title' => 'Tan',
                'group' => 'Brown',
                'hex_code' => '#D2B48C',
                'rgb_code' => '210, 180, 140'
            ],
            [
                'title' => 'RosyBrown',
                'group' => 'Brown',
                'hex_code' => '#BC8F8F',
                'rgb_code' => '188, 143, 143'
            ],
            [
                'title' => 'SandyBrown',
                'group' => 'Brown',
                'hex_code' => '#F4A460',
                'rgb_code' => '244, 164, 96'
            ],
            [
                'title' => 'Goldenrod',
                'group' => 'Brown',
                'hex_code' => '#DAA520',
                'rgb_code' => '218, 165, 32'
            ],
            [
                'title' => 'DarkGoldenRod',
                'group' => 'Brown',
                'hex_code' => '#B8860B',
                'rgb_code' => '184, 134, 11'
            ],
            [
                'title' => 'Peru',
                'group' => 'Brown',
                'hex_code' => '#CD853F',
                'rgb_code' => '205, 133, 63'
            ],
            [
                'title' => 'Chocolate',
                'group' => 'Brown',
                'hex_code' => '#D2691E',
                'rgb_code' => '210, 105, 30'
            ],
            [
                'title' => 'SaddleBrown',
                'group' => 'Brown',
                'hex_code' => '#8B4513',
                'rgb_code' => '139, 69, 19'
            ],
            [
                'title' => 'Sienna',
                'group' => 'Brown',
                'hex_code' => '#A0522D',
                'rgb_code' => '160, 82, 45'
            ],
            [
                'title' => 'Brown',
                'group' => 'Brown',
                'hex_code' => '#A52A2A',
                'rgb_code' => '165, 42, 42'
            ],
            [
                'title' => 'Maroon',
                'group' => 'Brown',
                'hex_code' => '#800000',
                'rgb_code' => '128, 0, 0'
            ],
            [
                'title' => 'Black',
                'group' => 'main',
                'hex_code' => '#000000',
                'rgb_code' => '0, 0, 0'
            ],
            [
                'title' => 'Gray',
                'group' => 'main',
                'hex_code' => '#808080',
                'rgb_code' => '128, 128, 128'
            ],
            [
                'title' => 'Silver',
                'group' => 'main',
                'hex_code' => '#C0C0C0',
                'rgb_code' => '192, 192, 192'
            ],
            [
                'title' => 'White',
                'group' => 'main',
                'hex_code' => '#FFFFFF',
                'rgb_code' => '255, 255, 255'
            ],
            [
                'title' => 'Fuchsia',
                'group' => 'main',
                'hex_code' => '#FF00FF',
                'rgb_code' => '255, 0, 255'
            ],
            [
                'title' => 'Purple',
                'group' => 'main',
                'hex_code' => '#800080',
                'rgb_code' => '128, 0, 128'
            ],
            [
                'title' => 'Red',
                'group' => 'main',
                'hex_code' => '#FF0000',
                'rgb_code' => '255, 0, 0'
            ],
            [
                'title' => 'Maroon',
                'group' => 'main',
                'hex_code' => '#800000',
                'rgb_code' => '128, 0, 0'
            ],
            [
                'title' => 'Yellow',
                'group' => 'main',
                'hex_code' => '#FFFF00',
                'rgb_code' => '255, 255, 0'
            ],
            [
                'title' => 'Olive',
                'group' => 'main',
                'hex_code' => '#808000',
                'rgb_code' => '128, 128, 0'
            ],
            [
                'title' => 'Lime',
                'group' => 'main',
                'hex_code' => '#00FF00',
                'rgb_code' => '0, 255, 0'
            ],
            [
                'title' => 'Green',
                'group' => 'main',
                'hex_code' => '#008000',
                'rgb_code' => '0, 128, 0'
            ],
            [
                'title' => 'Aqua',
                'group' => 'main',
                'hex_code' => '#00FFFF',
                'rgb_code' => '0, 255, 255'
            ],
            [
                'title' => 'Teal',
                'group' => 'main',
                'hex_code' => '#008080',
                'rgb_code' => '0, 128, 128'
            ],
            [
                'title' => 'Blue',
                'group' => 'main',
                'hex_code' => '#0000FF',
                'rgb_code' => '0, 0, 255'
            ],
            [
                'title' => 'Navy',
                'group' => 'main',
                'hex_code' => '#000080',
                'rgb_code' => '0, 0, 128'
            ],
            [
                'title' => 'GreenYellow',
                'group' => 'Green',
                'hex_code' => '#ADFF2F',
                'rgb_code' => '173, 255, 47'
            ],
            [
                'title' => 'Chartreuse',
                'group' => 'Green',
                'hex_code' => '#7FFF00',
                'rgb_code' => '127, 255, 0'
            ],
            [
                'title' => 'LawnGreen',
                'group' => 'Green',
                'hex_code' => '#7CFC00',
                'rgb_code' => '124, 252, 0'
            ],
            [
                'title' => 'Lime',
                'group' => 'Green',
                'hex_code' => '#00FF00',
                'rgb_code' => '0, 255, 0'
            ],
            [
                'title' => 'LimeGreen',
                'group' => 'Green',
                'hex_code' => '#32CD32',
                'rgb_code' => '50, 205, 50'
            ],
            [
                'title' => 'PaleGreen',
                'group' => 'Green',
                'hex_code' => '#98FB98',
                'rgb_code' => '152, 251, 152'
            ],
            [
                'title' => 'LightGreen',
                'group' => 'Green',
                'hex_code' => '#90EE90',
                'rgb_code' => '144, 238, 144'
            ],
            [
                'title' => 'MediumSpringGreen',
                'group' => 'Green',
                'hex_code' => '#00FA9A',
                'rgb_code' => '0, 250, 154'
            ],
            [
                'title' => 'SpringGreen',
                'group' => 'Green',
                'hex_code' => '#00FF7F',
                'rgb_code' => '0, 255, 127'
            ],
            [
                'title' => 'MediumSeaGreen',
                'group' => 'Green',
                'hex_code' => '#3CB371',
                'rgb_code' => '60, 179, 113'
            ],
            [
                'title' => 'SeaGreen',
                'group' => 'Green',
                'hex_code' => '#2E8B57',
                'rgb_code' => '46, 139, 87'
            ],
            [
                'title' => 'ForestGreen',
                'group' => 'Green',
                'hex_code' => '#228B22',
                'rgb_code' => '34, 139, 34'
            ],
            [
                'title' => 'Green',
                'group' => 'Green',
                'hex_code' => '#008000',
                'rgb_code' => '0, 128, 0'
            ],
            [
                'title' => 'DarkGreen',
                'group' => 'Green',
                'hex_code' => '#006400',
                'rgb_code' => '0, 100, 0'
            ],
            [
                'title' => 'YellowGreen',
                'group' => 'Green',
                'hex_code' => '#9ACD32',
                'rgb_code' => '154, 205, 50'
            ],
            [
                'title' => 'OliveDrab',
                'group' => 'Green',
                'hex_code' => '#6B8E23',
                'rgb_code' => '107, 142, 35'
            ],
            [
                'title' => 'Olive',
                'group' => 'Green',
                'hex_code' => '#808000',
                'rgb_code' => '128, 128, 0'
            ],
            [
                'title' => 'DarkOliveGreen',
                'group' => 'Green',
                'hex_code' => '#556B2F',
                'rgb_code' => '85, 107, 47'
            ],
            [
                'title' => 'MediumAquamarine',
                'group' => 'Green',
                'hex_code' => '#66CDAA',
                'rgb_code' => '102, 205, 170'
            ],
            [
                'title' => 'DarkSeaGreen',
                'group' => 'Green',
                'hex_code' => '#8FBC8F',
                'rgb_code' => '143, 188, 143'
            ],
            [
                'title' => 'LightSeaGreen',
                'group' => 'Green',
                'hex_code' => '#20B2AA',
                'rgb_code' => '32, 178, 170'
            ],
            [
                'title' => 'DarkCyan',
                'group' => 'Green',
                'hex_code' => '#008B8B',
                'rgb_code' => '0, 139, 139'
            ],
            [
                'title' => 'Teal',
                'group' => 'Green',
                'hex_code' => '#008080',
                'rgb_code' => '0, 128, 128'
            ],
            [
                'title' => 'Aqua',
                'group' => 'Blue',
                'hex_code' => '#00FFFF',
                'rgb_code' => '0, 255, 255'
            ],
            [
                'title' => 'Cyan',
                'group' => 'Blue',
                'hex_code' => '#00FFFF',
                'rgb_code' => '0, 255, 255'
            ],
            [
                'title' => 'LightCyan',
                'group' => 'Blue',
                'hex_code' => '#E0FFFF',
                'rgb_code' => '224, 255, 255'
            ],
            [
                'title' => 'PaleTurquoise',
                'group' => 'Blue',
                'hex_code' => '#AFEEEE',
                'rgb_code' => '175, 238, 238'
            ],
            [
                'title' => 'Aquamarine',
                'group' => 'Blue',
                'hex_code' => '#7FFFD4',
                'rgb_code' => '127, 255, 212'
            ],
            [
                'title' => 'Turquoise',
                'group' => 'Blue',
                'hex_code' => '#40E0D0',
                'rgb_code' => '64, 224, 208'
            ],
            [
                'title' => 'MediumTurquoise',
                'group' => 'Blue',
                'hex_code' => '#48D1CC',
                'rgb_code' => '72, 209, 204'
            ],
            [
                'title' => 'DarkTurquoise',
                'group' => 'Blue',
                'hex_code' => '#00CED1',
                'rgb_code' => '0, 206, 209'
            ],
            [
                'title' => 'CadetBlue',
                'group' => 'Blue',
                'hex_code' => '#5F9EA0',
                'rgb_code' => '95, 158, 160'
            ],
            [
                'title' => 'SteelBlue',
                'group' => 'Blue',
                'hex_code' => '#4682B4',
                'rgb_code' => '70, 130, 180'
            ],
            [
                'title' => 'LightSteelBlue',
                'group' => 'Blue',
                'hex_code' => '#B0C4DE',
                'rgb_code' => '176, 196, 222'
            ],
            [
                'title' => 'PowderBlue',
                'group' => 'Blue',
                'hex_code' => '#B0E0E6',
                'rgb_code' => '176, 224, 230'
            ],
            [
                'title' => 'LightBlue',
                'group' => 'Blue',
                'hex_code' => '#ADD8E6',
                'rgb_code' => '173, 216, 230'
            ],
            [
                'title' => 'SkyBlue',
                'group' => 'Blue',
                'hex_code' => '#87CEEB',
                'rgb_code' => '135, 206, 235'
            ],
            [
                'title' => 'LightSkyBlue',
                'group' => 'Blue',
                'hex_code' => '#87CEFA',
                'rgb_code' => '135, 206, 250'
            ],
            [
                'title' => 'DeepSkyBlue',
                'group' => 'Blue',
                'hex_code' => '#00BFFF',
                'rgb_code' => '0, 191, 255'
            ],
            [
                'title' => 'DodgerBlue',
                'group' => 'Blue',
                'hex_code' => '#1E90FF',
                'rgb_code' => '30, 144, 255'
            ],
            [
                'title' => 'CornflowerBlue',
                'group' => 'Blue',
                'hex_code' => '#6495ED',
                'rgb_code' => '100, 149, 237'
            ],
            [
                'title' => 'MediumSlateBlue',
                'group' => 'Blue',
                'hex_code' => '#7B68EE',
                'rgb_code' => '123, 104, 238'
            ],
            [
                'title' => 'RoyalBlue',
                'group' => 'Blue',
                'hex_code' => '#4169E1',
                'rgb_code' => '65, 105, 225'
            ],
            [
                'title' => 'Blue',
                'group' => 'Blue',
                'hex_code' => '#0000FF',
                'rgb_code' => '0, 0, 255'
            ],
            [
                'title' => 'MediumBlue',
                'group' => 'Blue',
                'hex_code' => '#0000CD',
                'rgb_code' => '0, 0, 205'
            ],
            [
                'title' => 'DarkBlue',
                'group' => 'Blue',
                'hex_code' => '#00008B',
                'rgb_code' => '0, 0, 139'
            ],
            [
                'title' => 'Navy',
                'group' => 'Blue',
                'hex_code' => '#000080',
                'rgb_code' => '0, 0, 128'
            ],
            [
                'title' => 'MidnightBlue',
                'group' => 'Blue',
                'hex_code' => '#191970',
                'rgb_code' => '25, 25, 112'
            ],
            [
                'title' => 'White',
                'group' => 'White',
                'hex_code' => '#FFFFFF',
                'rgb_code' => '255, 255, 255'
            ],
            [
                'title' => 'Snow',
                'group' => 'White',
                'hex_code' => '#FFFAFA',
                'rgb_code' => '255, 250, 250'
            ],
            [
                'title' => 'Honeydew',
                'group' => 'White',
                'hex_code' => '#F0FFF0',
                'rgb_code' => '240, 255, 240'
            ],
            [
                'title' => 'MintCream',
                'group' => 'White',
                'hex_code' => '#F5FFFA',
                'rgb_code' => '245, 255, 250'
            ],
            [
                'title' => 'Azure',
                'group' => 'White',
                'hex_code' => '#F0FFFF',
                'rgb_code' => '240, 255, 255'
            ],
            [
                'title' => 'AliceBlue',
                'group' => 'White',
                'hex_code' => '#F0F8FF',
                'rgb_code' => '240, 248, 255'
            ],
            [
                'title' => 'GhostWhite',
                'group' => 'White',
                'hex_code' => '#F8F8FF',
                'rgb_code' => '248, 248, 255'
            ],
            [
                'title' => 'WhiteSmoke',
                'group' => 'White',
                'hex_code' => '#F5F5F5',
                'rgb_code' => '245, 245, 245'
            ],
            [
                'title' => 'Seashell',
                'group' => 'White',
                'hex_code' => '#FFF5EE',
                'rgb_code' => '255, 245, 238'
            ],
            [
                'title' => 'Beige',
                'group' => 'White',
                'hex_code' => '#F5F5DC',
                'rgb_code' => '245, 245, 220'
            ],
            [
                'title' => 'OldLace',
                'group' => 'White',
                'hex_code' => '#FDF5E6',
                'rgb_code' => '253, 245, 230'
            ],
            [
                'title' => 'FloralWhite',
                'group' => 'White',
                'hex_code' => '#FFFAF0',
                'rgb_code' => '255, 250, 240'
            ],
            [
                'title' => 'Ivory',
                'group' => 'White',
                'hex_code' => '#FFFFF0',
                'rgb_code' => '255, 255, 240'
            ],
            [
                'title' => 'AntiqueWhite',
                'group' => 'White',
                'hex_code' => '#FAEBD7',
                'rgb_code' => '250, 235, 215'
            ],
            [
                'title' => 'Linen',
                'group' => 'White',
                'hex_code' => '#FAF0E6',
                'rgb_code' => '250, 240, 230'
            ],
            [
                'title' => 'LavenderBlush',
                'group' => 'White',
                'hex_code' => '#FFF0F5',
                'rgb_code' => '255, 240, 245'
            ],
            [
                'title' => 'MistyRose',
                'group' => 'White',
                'hex_code' => '#FFE4E1',
                'rgb_code' => '255, 228, 225'
            ],
            [
                'title' => 'Gainsboro',
                'group' => 'Gray',
                'hex_code' => '#DCDCDC',
                'rgb_code' => '220, 220, 220'
            ],
            [
                'title' => 'LightGrey',
                'group' => 'Gray',
                'hex_code' => '#D3D3D3',
                'rgb_code' => '211, 211, 211'
            ],
            [
                'title' => 'LightGray',
                'group' => 'Gray',
                'hex_code' => '#D3D3D3',
                'rgb_code' => '211, 211, 211'
            ],
            [
                'title' => 'Silver',
                'group' => 'Gray',
                'hex_code' => '#C0C0C0',
                'rgb_code' => '192, 192, 192'
            ],
            [
                'title' => 'DarkGray',
                'group' => 'Gray',
                'hex_code' => '#A9A9A9',
                'rgb_code' => '169, 169, 169'
            ],
            [
                'title' => 'DarkGrey',
                'group' => 'Gray',
                'hex_code' => '#A9A9A9',
                'rgb_code' => '169, 169, 169'
            ],
            [
                'title' => 'Gray',
                'group' => 'Gray',
                'hex_code' => '#808080',
                'rgb_code' => '128, 128, 128'
            ],
            [
                'title' => 'Grey',
                'group' => 'Gray',
                'hex_code' => '#808080',
                'rgb_code' => '128, 128, 128'
            ],
            [
                'title' => 'DimGray',
                'group' => 'Gray',
                'hex_code' => '#696969',
                'rgb_code' => '105, 105, 105'
            ],
            [
                'title' => 'DimGrey',
                'group' => 'Gray',
                'hex_code' => '#696969',
                'rgb_code' => '105, 105, 105'
            ],
            [
                'title' => 'LightSlateGray',
                'group' => 'Gray',
                'hex_code' => '#778899',
                'rgb_code' => '119, 136, 153'
            ],
            [
                'title' => 'LightSlateGrey',
                'group' => 'Gray',
                'hex_code' => '#778899',
                'rgb_code' => '119, 136, 153'
            ],
            [
                'title' => 'SlateGray',
                'group' => 'Gray',
                'hex_code' => '#708090',
                'rgb_code' => '112, 128, 144'
            ],
            [
                'title' => 'SlateGrey',
                'group' => 'Gray',
                'hex_code' => '#708090',
                'rgb_code' => '112, 128, 144'
            ],
            [
                'title' => 'DarkSlateGray',
                'group' => 'Gray',
                'hex_code' => '#2F4F4F',
                'rgb_code' => '47, 79, 79'
            ],
            [
                'title' => 'DarkSlateGrey',
                'group' => 'Gray',
                'hex_code' => '#2F4F4F',
                'rgb_code' => '47, 79, 79'
            ],
            [
                'title' => 'Black',
                'group' => 'Gray',
                'hex_code' => '#000000',
                'rgb_code' => '0, 0, 0'
            ]
        ];
        Color::insert($colors);
    }
}
