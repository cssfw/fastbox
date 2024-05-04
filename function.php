<?php
function getpass($directoryPath) {
    // 获取目录中所有文件和文件夹的列表
    $fileList = scandir($directoryPath);
    
    // 判断第一个文件夹名称是否为空
    if (!empty($fileList)) {
        $firstDirectory = $fileList[2];
        if (is_dir($directoryPath . DIRECTORY_SEPARATOR . $firstDirectory)) {
            return $firstDirectory;
        }
    }
    
    // 如果没有找到任何文件夹，则返回空字符串
    return "程序错误!!!";
}




function fget($directoryPath, $fileName) {
    // 拼接文件路径
    $filePath = $directoryPath . DIRECTORY_SEPARATOR . $fileName;
    
    // 判断文件是否存在
    if (@file_exists($filePath)) {
        // 打开文件并读取内容
        $handle = fopen($filePath, "r");
        $fileContent = fread($handle, filesize($filePath));
        fclose($handle);
        return $fileContent;
    }
    
    // 如果文件不存在，则返回空字符串
    return "";
}
fget($directoryPath, $fileName);
?>
