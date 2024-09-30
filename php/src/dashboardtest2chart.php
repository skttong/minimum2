<!DOCTYPE html>
<html>
<head>
    <title>Interactive Chart.js Example</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="chart1"></canvas>
    <canvas id="chart2" style="display: none;"></canvas> 
    <script>
       // ข้อมูลตัวอย่าง
const data1 = {
    labels: ['Red1', 'Blue1', 'Yellow1','Red2', 'Blue2', 'Yellow2','Red3', 'Blue3', 'Yellow3','Red4', 'Blue4', 'Yellow4','Red5'],
    datasets: [{
        label: 'Dataset 1',
        data: [12, 19, 3, 23, 32, 10,15,12,35,32,21,25,12],
        backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
        ]
    }]
};

// ข้อมูลตัวอย่าง (ขยายเป็น 13 ชุด)
const data2Sets = [
    {
        title:['1','2','3'],
        label: 'Red1',
        data: [10, 5, 15],
        backgroundColor: 'rgb(255, 99, 132)'
    },
    {
        title:['1','2','3'],
        label: 'Blue1',
        data: [10, 25, 15],
        backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
        ]
    },
    {
        title:['1','2','3'],
        label: 'Yellow1',
        data: [10, 15, 15],
        backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
        ]
    },
    {
        title:['1','2','3'],
        label: 'Red2',
        data: [10, 55, 15],
        backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
        ]
    },
    {
        title:['1','2','3'],
        label: 'Blue2',
        data: [10, 35, 15],
        backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
        ]
    },
    {
        title:['1','2','3'],
        label: 'Yellow2',
        data: [10, 15, 15],
        backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
        ]
    },
    {
        title:['1','2','3'],
        label: 'Red3',
        data: [10, 25, 15],
        backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
        ]
    },
    {
        title:['1','2','3'],
        label: 'Blue3',
        data: [10, 65, 15],
        backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
        ]
    },
    {
        title:['1','2','3'],
        label: 'Yellow3',
        data: [10, 25, 15],
        backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
        ]
    },
    {
        title:['1','2','3'],
        label: 'Red4',
        data: [10, 35, 15],
        backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
        ]
    }, 
    {
        title:['1','2','3'],
        label: 'Blue4',
        data: [10, 25, 15],
        backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
        ]
    },
    {
        title:['1','2','3'],
        label: 'Yellow4',
        data: [1, 5, 15],
        backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
        ]
    },
    {
        title:['1','2','3'],
        label: 'Red5',
        data: [10, 15, 15],
        backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
        ]
    },
    // ... เพิ่มอีก 12 ชุดข้อมูล ...
];

// Mapping ระหว่าง index ใน data1 กับ index ใน data2Sets
const dataMapping = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12] // ปรับตามความต้องการ


// สร้างกราฟ
const ctx1 = document.getElementById('chart1').getContext('2d');
const chart1 = new Chart(ctx1, {
    type: 'bar',
    data: data1,
    options: {
        onClick: (event, elements) => {
            // เมื่อคลิกที่แท่งในกราฟแรก
            if (elements.length > 0) {
                const index = elements[0].index;
                // อัปเดตข้อมูลในกราฟที่สองตามค่าที่เกี่ยวข้อง
                data2.datasets[0].data[index] = data1.datasets[0].data[index] * 2;
                chart2.update();
            }
        }
    }
});

// สร้างกราฟ
const ctx2 = document.getElementById('chart2').getContext('2d');
let chart2;

// ฟังก์ชันสร้างและอัปเดตกราฟที่สอง
function createOrUpdateChart2(datasetIndex) {
    
   // console.log("datasetIndex:", datasetIndex);
   // console.log("datasetIndex:", data2Sets[datasetIndex].labels);
    //console.log("datasetIndex:", data2Sets[datasetIndex].data);
    
    if (!chart2) {
        chart2 = new Chart(ctx2, {
            type: 'bar', // เปลี่ยน type ตามต้องการ
            data: {
                labels: data2Sets[datasetIndex].title,
                datasets: [{
                    label: data2Sets[datasetIndex].label, // เพิ่ม label สำหรับ dataset
                    data: data2Sets[datasetIndex].data,
                    backgroundColor: data2Sets[datasetIndex].backgroundColor
                }]
            },
            options: {
                // เพิ่ม options ต่างๆ ของกราฟที่สอง
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        document.getElementById('chart2').style.display = 'block';
        
    } else {
        chart2.data = {
            labels: data2Sets[datasetIndex].title,
                datasets: [{
                    label: data2Sets[datasetIndex].label, // เพิ่ม label สำหรับ dataset
                    data: data2Sets[datasetIndex].data,
                    backgroundColor: data2Sets[datasetIndex].backgroundColor
                }]
        };
        chart2.update();
    }

    // เพิ่ม log ข้อมูล
    //console.log('Clicked index:', indexInData1);
    console.log('Dataset index:', datasetIndex);
    console.log('Data for chart2:', data2Sets[datasetIndex].data);
}

// เหตุการณ์คลิกที่กราฟแรก
chart1.options.onClick = (event, elements) => {
    if (elements.length > 0) {
        const indexInData1 = elements[0].index;
        const datasetIndex = dataMapping[indexInData1];

        // ตรวจสอบขอบเขตของ index
        if (datasetIndex >= 0 && datasetIndex < data2Sets.length) {
            createOrUpdateChart2(datasetIndex);
        } else {
            console.error('Invalid dataset index:', datasetIndex);
        }
    }
};

    </script>
</body>
</html>