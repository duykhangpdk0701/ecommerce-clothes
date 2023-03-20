import React, { FC } from "react";
import dynamic from "next/dynamic";
const ReactApexChart = dynamic(() => import("react-apexcharts"), {
  ssr: false,
});
// @mui
import Box from "@mui/material/Box";
import Card from "@mui/material/Card";
import CardHeader from "@mui/material/CardHeader";
// utils
import { fNumber } from "@/utils/formatNumber";
// components
import useChart from "@/components/shared/chart/useChart";

// ----------------------------------------------------------------------

interface IAppConversionRates {
  title?: string;
  subheader?: string;
  chartData: { label: string; value: number }[];
}

const AppConversionRates: FC<IAppConversionRates> = (props) => {
  const { title, subheader, chartData, ...other } = props;

  const chartLabels = chartData.map((i) => i.label);

  const chartSeries = chartData.map((i) => i.value);

  const chartOptions = useChart({
    tooltip: {
      marker: { show: false },
      y: {
        formatter: (seriesName: any) => fNumber(seriesName),
        title: {
          formatter: () => "",
        },
      },
    },
    plotOptions: {
      bar: { horizontal: true, barHeight: "28%", borderRadius: 2 },
    },
    xaxis: {
      categories: chartLabels,
    },
  });

  return (
    <Card {...other}>
      <CardHeader title={title} subheader={subheader} />

      <Box sx={{ mx: 3 }}>
        <ReactApexChart
          type="bar"
          series={[{ data: chartSeries }]}
          options={chartOptions}
          height={364}
          width={"100%"}
        />
      </Box>
    </Card>
  );
};

export default AppConversionRates;
