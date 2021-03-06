USE [ParallelDB]
GO
/****** Object:  Table [dbo].[TimeTrack]    Script Date: 4/5/2021 3:23:11 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[TimeTrack](
	[EmployeeCode] [nvarchar](50) NOT NULL,
	[LogDateTime] [datetime] NOT NULL,
	[LogDate] [date] NOT NULL,
	[LogTime] [time](7) NOT NULL,
	[Direction] [nvarchar](50) NOT NULL
) ON [PRIMARY]

GO
