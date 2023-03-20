import React, { FC } from "react";
// @mui
import Card from "@mui/material/Card";
import Typography from "@mui/material/Typography";
import CardHeader from "@mui/material/CardHeader";
import CardContent from "@mui/material/CardContent";

import Timeline from "@mui/lab/Timeline";
import TimelineDot from "@mui/lab/TimelineDot";
import TimelineItem from "@mui/lab/TimelineItem";
import TimelineContent from "@mui/lab/TimelineContent";
import TimelineSeparator from "@mui/lab/TimelineSeparator";
import TimelineConnector from "@mui/lab/TimelineConnector";

// utils
import { fDateTime } from "@/utils/formatTime";

// ----------------------------------------------------------------------

interface IAppOrderTimeline {
  title?: string;
  subheader?: string;
  list: {
    id: string;
    title: string;
    type: string;
    time: Date;
  }[];
}

const AppOrderTimeline: FC<IAppOrderTimeline> = (props) => {
  const { title, subheader, list, ...other } = props;

  return (
    <Card {...other}>
      <CardHeader title={title} subheader={subheader} />

      <CardContent
        sx={{
          "& .MuiTimelineItem-missingOppositeContent:before": {
            display: "none",
          },
        }}
      >
        <Timeline>
          {list.map((item, index) => (
            <OrderItem
              key={item.id}
              item={item}
              isLast={index === list.length - 1}
            />
          ))}
        </Timeline>
      </CardContent>
    </Card>
  );
};

// ----------------------------------------------------------------------

interface IOrderItem {
  isLast: boolean;
  item: {
    id: string;
    time: Date;
    title: string;
    type: string;
  };
}

const OrderItem: FC<IOrderItem> = (props) => {
  const { item, isLast } = props;
  const { type, title, time } = item;
  return (
    <TimelineItem>
      <TimelineSeparator>
        <TimelineDot
          color={
            (type === "order1" && "primary") ||
            (type === "order2" && "success") ||
            (type === "order3" && "info") ||
            (type === "order4" && "warning") ||
            "error"
          }
        />
        {isLast ? null : <TimelineConnector />}
      </TimelineSeparator>

      <TimelineContent>
        <Typography variant="subtitle2">{title}</Typography>

        <Typography variant="caption" sx={{ color: "text.secondary" }}>
          {fDateTime(time)}
        </Typography>
      </TimelineContent>
    </TimelineItem>
  );
};

export default AppOrderTimeline;
