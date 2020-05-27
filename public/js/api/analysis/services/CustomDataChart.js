angular.module('ExtentX').
    factory('CustomDataChart', function() {
        return {
            getDataCustomChart: function(data, dataPoints) {
                var startTimeFlag = "";
                var result = [];

                var passParentLength = 0;
                var failParentLength = 0;
                var fatalParentLength = 0;
                var errorParentLength = 0;
                var warningParentLength = 0;
                var skipParentLength = 0;
                var unknownParentLength = 0;

                var passChildLength = 0;
                var failChildLength = 0;
                var fatalChildLength = 0;
                var errorChildLength = 0;
                var warningChildLength = 0;
                var skipChildLength = 0;
                var infoChildLength = 0;
                var unknownChildLength = 0;

                if (data != null && data.length > 0) {
                    for (var i = 0; i < data.length - 1; i++) {
                        var startTime = "";
                        if (data[i].startTime != null) {
                            startTime = data[i].startTime.substring(0,10);
                        }

                        if (i == 0) {
                            startTimeFlag = startTime;
                        }
                        if (startTimeFlag != startTime) {
                            // Add new object
                            var dataObj = new Object();
                            dataObj.childLength = 0;
                            dataObj.endTime = startTimeFlag;
                            dataObj.fileName = "";
                            dataObj.id = "";
                            dataObj.project = "";
                            dataObj.startTime = startTimeFlag;

                            dataObj.passParentLength = passParentLength;
                            dataObj.failParentLength = failParentLength;
                            dataObj.fatalParentLength = fatalParentLength;
                            dataObj.errorParentLength = errorParentLength;
                            dataObj.warningParentLength = warningParentLength;
                            dataObj.skipParentLength = skipParentLength;
                            dataObj.unknownParentLength = unknownParentLength;

                            dataObj.passChildLength = passChildLength;
                            dataObj.failChildLength = failChildLength;
                            dataObj.fatalChildLength = fatalChildLength;
                            dataObj.errorChildLength = errorChildLength;
                            dataObj.warningChildLength = warningChildLength;
                            dataObj.skipChildLength = skipChildLength;
                            dataObj.infoChildLength = infoChildLength;
                            dataObj.unknownChildLength = unknownChildLength;

                            result.push(dataObj);

                            startTimeFlag = startTime;
                            // Clear value
                            passParentLength = 0;
                            failParentLength = 0;
                            fatalParentLength = 0;
                            errorParentLength = 0;
                            warningParentLength = 0;
                            skipParentLength = 0;
                            unknownParentLength = 0;

                            passChildLength = 0;
                            failChildLength = 0;
                            fatalChildLength = 0;
                            errorChildLength = 0;
                            warningChildLength = 0;
                            skipChildLength = 0;
                            infoChildLength = 0;
                            unknownChildLength = 0;

                        }

                        if (parseInt(data[i].passParentLength) > 0) {
                            passParentLength = parseInt(data[i].passParentLength) + passParentLength;
                        }
                        if (parseInt(data[i].failParentLength) > 0) {
                            failParentLength = data[i].failParentLength + failParentLength;
                        }
                        if (parseInt(data[i].fatalParentLength) > 0) {
                            fatalParentLength = data[i].fatalParentLength + fatalParentLength;
                        }
                        if (parseInt(data[i].errorParentLength) > 0) {
                            errorParentLength = data[i].errorParentLength + errorParentLength;
                        }
                        if (parseInt(data[i].warningParentLength) > 0) {
                            warningParentLength = data[i].warningParentLength + warningParentLength;
                        }
                        if (parseInt(data[i].skipParentLength) > 0) {
                            skipParentLength = data[i].skipParentLength + skipParentLength;
                        }
                        if (parseInt(data[i].unknownParentLength) > 0) {
                            unknownParentLength = data[i].unknownParentLength + unknownParentLength;
                        }
                        if (parseInt(data[i].passChildLength) > 0) {
                            passChildLength = data[i].passChildLength + passChildLength;
                        }
                        if (parseInt(data[i].failChildLength) > 0) {
                            failChildLength = data[i].failChildLength + failChildLength;
                        }
                        if (parseInt(data[i].fatalChildLength) > 0) {
                            fatalChildLength = data[i].fatalChildLength + fatalChildLength;
                        }
                        if (parseInt(data[i].errorChildLength) > 0) {
                            errorChildLength = data[i].errorChildLength + errorChildLength;
                        }
                        if (parseInt(data[i].warningChildLength) > 0) {
                            warningChildLength = data[i].warningChildLength + warningChildLength;
                        }
                        if (parseInt(data[i].skipChildLength) > 0) {
                            skipChildLength = data[i].skipChildLength + skipChildLength;
                        }
                        if (parseInt(data[i].infoChildLength) > 0) {
                            infoChildLength = data[i].infoChildLength + infoChildLength;
                        }
                        if (parseInt(data[i].unknownChildLength) > 0) {
                            unknownChildLength = data[i].unknownChildLength + unknownChildLength;
                        }
                    }
                }
                return result;
            }
        }
    });