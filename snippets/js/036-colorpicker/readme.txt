
options. 

initApplication

buildCache
buildDataUrl

toHex
invertColor -> invert color Cache
buildImageCache

bindEventListeners
pickerMouseUpEvent
pickerMouseMoveEvent
pickerMouseDownEvent
afterMouseUpGlobalEvent
rangeChangeEvent
colorInvertInputChangeEvent
colorInputChangeEvent
restoreLastPickedColors

rememberLastPickedColors
getLastPickedColors
rememberLastRange
restoreLastRange
rememberLastPickedColor
restoreLastPickedColor
saveCache -> save cache state on index
restoreCache -> restore cache state on index

drawColorPicker
setColorOnPosition
mousePositionToColor
selectColor
changeColorInvertInput
changeColorInput
addPickedColor
selectPickedColorEvent -> event for select color in picked color list; restore remembered color to color picker
pickColorFromMousePosition -> get color from mouse position in color picker ; add color to picket color list
colorToRange -> convert color to range number
changeColorRange -> set color picker to specific range

Tools

l > log to console shotcut
id -> get element by id
toHex -> convert decimal number to hex string
invertColor -> invert color for invert color input

#################

[x] remove button for picked color list
- add button for each picked color to javascript function addPickedColor,
- add event for button 
- after click to delete button remove picked color from list
- close button transparent when is not hover on button
- small x in upper right corner with shadow

[x] fix cache 
- store cache in localstorage
- restore cache istead of build if exists
- store cache in json file > function to build json cache store in file

[x] start building cache after 3 seconds 
- use timer for evry block
- display notification > cache building

[] drag and drop for picked colors 
- remove color with drag item out of list



